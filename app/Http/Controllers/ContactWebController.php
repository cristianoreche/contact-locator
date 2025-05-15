<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Services\MockGeocoderService;
use Illuminate\Support\Facades\Response;

class ContactWebController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('name')->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view(view: 'contacts.create');
    }

    public function store(ContactStoreRequest $request, MockGeocoderService $geo)
    {
        $data = $request->validated();
        $coords = $geo->getCoordinatesFromAddress($data);

        if (!$coords) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Não foi possível obter coordenadas.');
        }

        Contact::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'phone' => $data['phone'],
            'cep' => $data['cep'],
            'state' => $data['state'],
            'city' => $data['city'],
            'bairro' => $data['bairro'] ?? null,
            'street' => $data['street'],
            'number' => $data['number'],
            'complement' => $data['complement'] ?? null,
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contato salvo com sucesso.');
    }


    public function edit($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactUpdateRequest $request, MockGeocoderService $geo, $id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $data = $request->validated();

        $coords = $geo->getCoordinatesFromAddress($data);

        if (!$coords) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Não foi possível obter coordenadas.');
        }

        $contact->update([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'phone' => $data['phone'],
            'cep' => $data['cep'],
            'state' => $data['state'],
            'city' => $data['city'],
            'bairro' => $data['bairro'] ?? null,
            'street' => $data['street'],
            'number' => $data['number'],
            'complement' => $data['complement'] ?? null,
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso.');
    }

    public function export()
    {
        $contacts = Contact::where('user_id', auth()->id())->get();

        $csv = [];
        $csv[] = [
            'Nome',
            'CPF',
            'Telefone',
            'CEP',
            'Estado',
            'Cidade',
            'Bairro',
            'Rua',
            'Número',
            'Complemento',
            'Latitude',
            'Longitude'
        ];

        foreach ($contacts as $contact) {
            $csv[] = [
                $contact->name,
                $contact->cpf,
                $contact->phone,
                $contact->cep,
                $contact->state,
                $contact->city,
                $contact->bairro,
                $contact->street,
                $contact->number,
                $contact->complement,
                $contact->latitude,
                $contact->longitude,
            ];
        }

        $filename = 'contatos_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://temp', 'r+');

        foreach ($csv as $line) {
            fputcsv($handle, $line, ';');
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return Response::make($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }


    public function destroy($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contato removido com sucesso.');
    }
}
