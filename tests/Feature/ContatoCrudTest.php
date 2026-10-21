<?php

namespace Tests\Feature;

use App\Models\Contato;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContatoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_lists_contacts_and_has_delete_confirmation(): void
    {
        $contato = $this->createContato();

        $this->get('/')
            ->assertOk()
            ->assertSee($contato->nome)
            ->assertSee('confirmDeleteModal')
            ->assertSee(route('contatos.delete', $contato->id));
    }

    public function test_contato_can_be_created_and_updated(): void
    {
        $dados = [
            'nome' => 'Ana Souza',
            'telefone' => '11999990000',
            'email' => 'ana@example.com',
            'endereco' => 'Rua das Flores, 10',
        ];

        $this->post('/save', $dados)
            ->assertRedirect('/');

        $this->assertDatabaseHas('contatos', $dados);
        $contato = Contato::query()->where('email', $dados['email'])->firstOrFail();

        $dados['nome'] = 'Ana Souza Atualizada';
        $this->put('/update/' . $contato->id, $dados)
            ->assertRedirect('/');

        $this->assertDatabaseHas('contatos', $dados);
    }

    public function test_contato_can_be_deleted(): void
    {
        $contato = $this->createContato();

        $this->delete('/delete/' . $contato->id)
            ->assertRedirect('/');

        $this->assertDatabaseMissing('contatos', ['id' => $contato->id]);
    }

    private function createContato(): Contato
    {
        $contato = new Contato();
        $contato->nome = 'Ana Souza';
        $contato->telefone = '11999990000';
        $contato->email = 'ana@example.com';
        $contato->endereco = 'Rua das Flores, 10';
        $contato->save();

        return $contato;
    }
}
