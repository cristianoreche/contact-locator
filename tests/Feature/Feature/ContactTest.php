<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_create_and_list_contacts()
    {
        $this->withoutExceptionHandling();

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/contacts', [
            'name'       => 'João da Silva',
            'cpf'        => '11144477735',
            'phone'      => '41999999999',
            'cep'        => '80000000',
            'state'      => 'PR',
            'city'       => 'Curitiba',
            'street'     => 'Rua Teste',
            'number'     => '123',
            'complement' => '',
        ]);

        dd($response->json());
        
        $response->assertCreated();

        $list = $this->getJson('/api/contacts');
        $list->assertOk()->assertJsonFragment(['name' => 'João da Silva']);
    }
}
