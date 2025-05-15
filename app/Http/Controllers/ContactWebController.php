<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Services\MockGeocoderService;


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

    public function location($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);

        return view('contacts.show-location', compact('contact'));
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


    public function destroy($id)
    {
        $contact = Contact::where('user_id', auth()->id())->findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contato removido com sucesso.');
    }
}
