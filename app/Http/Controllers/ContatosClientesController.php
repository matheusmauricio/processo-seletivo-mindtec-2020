<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContatosClientesModel;

class ContatosClientesController extends Controller
{

    public function cadastrarContato($idCliente){
        return view('cadastrar-contato-cliente', compact('idCliente'));
    }

    public function cadastrar(Request $request){
        $contatoCliente = ContatosClientesModel::orderBy('TipoContato');
        $contatoCliente->insert(['IdCliente' => $request->idCliente, 'TipoContato' => $request->tipoContato, 'DescContato' => $request->descContato, 'BolAtivo' => '1']);

        return redirect('detalhar-cliente/' . $request->idCliente)->with('sucesso', 'Contato cadastrado com sucesso!');
    }

    public function detalhar($idContato){
        $contatoCliente = ContatosClientesModel::orderBy('TipoContato');
        $contatoCliente->where('IdContato', '=', $idContato);
        $contatoCliente = $contatoCliente->first();

        return view('detalhar-contato-cliente', compact('contatoCliente'));
    }

    public function editar(Request $request){
        $dados = $request->all();

        $contatoAlterado = ContatosClientesModel::orderBy('TipoContato');
        $contatoAlterado->where('IdContato', '=', $dados['idContato']);
        $contatoAlterado->update(['TipoContato' => $dados['tipoContato'], 'DescContato' => $dados['descContato'], 'BolAtivo' => $dados['ativo']]);
        
        return redirect('detalhar-cliente/' . $dados['idCliente'])->with('sucesso', 'Contato alterado com sucesso!');
    }

    public function excluir(Request $request){
        $dados = $request->all();

        $contatoAlterado = ContatosClientesModel::orderBy('TipoContato');
        $contatoAlterado->where('IdContato', '=', $dados['idContato']);
        $contatoAlterado->update(['BolAtivo' => '0']);

        return redirect('detalhar-cliente/' . $dados['idCliente'])->with('sucesso', 'Contato do Cliente excluído com sucesso!');
    }
}
