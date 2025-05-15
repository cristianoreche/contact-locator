<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddressService
{
    public function searchByCep(string $cep): ?array
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || $response->json('erro') === true) {
            return null;
        }

        return $response->json();
    }
}
