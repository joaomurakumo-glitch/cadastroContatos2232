<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;

class ContatoController extends Controller
{
    //GET
    public function index()
    {
        //Model pega os dados do banco e traz
        $contatos = Contato::all();

        //Retorna os dados em formato JSON (para teste)
        //return response()->json($contatos);

        //Envia valores para a view
        return view('contatos', ['contatos' => $contatos]);
    }

    //POST
    public function form(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'endereco' => ['required', 'string', 'max:255'],
        ]);

        $contato = new Contato();
        $contato->nome = $dados['nome'];
        $contato->telefone = $dados['telefone'];
        $contato->email = $dados['email'];
        $contato->endereco = $dados['endereco'];
        $contato->save(); //salva no banco de dados

        return redirect('/'); //redireciona a home
    }

    //DELETE: remove o registro no banco de dados
    public function delete($id)
    {
        //Busca o contato pelo id
        $contato = Contato::findOrFail($id);
        $contato->delete();

        return redirect('/'); //retorna a home
    }

    public function edit($id)
    {
        //Busca o contato pelo id
        $contato = Contato::findOrFail($id);

        //Abre a view de edição com o registro buscado
        return view('edit', ['contato' => $contato]);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'endereco' => ['required', 'string', 'max:255'],
        ]);

        $contato = Contato::findOrFail($id);
        $contato->nome = $dados['nome'];
        $contato->telefone = $dados['telefone'];
        $contato->email = $dados['email'];
        $contato->endereco = $dados['endereco'];
        $contato->save();

        return redirect('/');
    }

}
