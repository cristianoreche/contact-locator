<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Models\Contact;
use App\Services\MockGeocoderService;
use App\Services\Loggers\AuditLogger;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%");
            });
        }

        $query->orderBy('name');
        $perPage = $request->input('per_page', 10);
        $contacts = $query->paginate($perPage);

        return response()->json($contacts);
    }

    public function store(ContactStoreRequest $request, MockGeocoderService $geo)
    {
        $data = $request->validated();
        $coords = $geo->getCoordinatesFromAddress($data);

        if (!$coords) {
            return response()->json(['message' => 'Não foi possível obter coordenadas.'], 400);
        }

        $contact = Contact::create([
            'user_id'    => auth()->id(),
            'name'       => $data['name'],
            'cpf'        => $data['cpf'],
            'phone'      => $data['phone'],
            'cep'        => $data['cep'],
            'state'      => $data['state'],
            'city'       => $data['city'],
            'bairro'     => $data['bairro'] ?? null,
            'street'     => $data['street'],
            'number'     => $data['number'],
            'complement' => $data['complement'] ?? null,
            'latitude'   => $coords['lat'],
            'longitude'  => $coords['lng'],
        ]);

        AuditLogger::log('created_contact', "Criou o contato '{$contact->name}' (ID {$contact->id})");

        return response()->json(['message' => 'Contato salvo com sucesso.', 'contact' => $contact], 201);
    }

    public function update(ContactUpdateRequest $request, MockGeocoderService $geo, $id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $data = $request->validated();
        $coords = $geo->getCoordinatesFromAddress($data);

        if (!$coords) {
            return response()->json(['message' => 'Não foi possível obter coordenadas.'], 400);
        }

        $contact->update([
            'name'       => $data['name'],
            'cpf'        => $data['cpf'],
            'phone'      => $data['phone'],
            'cep'        => $data['cep'],
            'state'      => $data['state'],
            'city'       => $data['city'],
            'bairro'     => $data['bairro'] ?? null,
            'street'     => $data['street'],
            'number'     => $data['number'],
            'complement' => $data['complement'] ?? null,
            'latitude'   => $coords['lat'],
            'longitude'  => $coords['lng'],
        ]);

        AuditLogger::log('updated_contact', "Atualizou o contato '{$contact->name}' (ID {$contact->id})");

        return response()->json(['message' => 'Contato atualizado com sucesso.', 'contact' => $contact]);
    }

    public function destroy($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        AuditLogger::log('deleted_contact', "Excluiu o contato '{$contact->name}' (ID {$contact->id})");

        return response()->json(['message' => 'Contato removido com sucesso.']);
    }

    public function showLocation($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);

        return response()->json([
            'latitude' => $contact->latitude,
            'longitude' => $contact->longitude,
        ]);
    }

    public function show($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);

        AuditLogger::log('viewed_contact', "Visualizou o contato '{$contact->name}' (ID {$contact->id})");

        return response()->json($contact);
    }
}
