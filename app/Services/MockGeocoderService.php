<?php

namespace App\Services;

class MockGeocoderService
{
    public function getCoordinatesFromAddress(array $data): array
    {
        // Você não precisa registrar nada no service container — o Laravel já injeta automaticamente se você usar a assinatura certa no controller.
        // Simula coordenadas com base no CEP, cidade ou fallback
        $cidade = strtolower($data['city'] ?? '');

        return match (true) {
            str_contains($cidade, 'curitiba') => ['lat' => -25.4284, 'lng' => -49.2733],
            str_contains($cidade, 'ponta grossa') => ['lat' => -25.0951, 'lng' => -50.1619],
            str_contains($cidade, 'londrina') => ['lat' => -23.3045, 'lng' => -51.1696],
            default => ['lat' => -25.5000, 'lng' => -49.2000], // fallback genérico
        };
    }
}
