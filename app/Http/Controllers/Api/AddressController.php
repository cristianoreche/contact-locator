<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected AddressService $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function search(Request $request)
    {
        $request->validate([
            'cep' => ['required', 'regex:/^\d{8}$/'],
        ]);

        $address = $this->addressService->searchByCep($request->cep);

        if (!$address) {
            return response()->json(['message' => 'CEP não encontrado.'], 404);
        }

        return response()->json($address);
    }
}
