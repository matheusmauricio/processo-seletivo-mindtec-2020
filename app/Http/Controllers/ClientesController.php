<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientesModel;
use App\Models\ContatosClientesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    public function listar(){
        $clientes = ClientesModel::orderBy('RazaoSocial');
        $clientes = $clientes->paginate(15);
        
        foreach($clientes as $cliente){
            $cliente->DataCadastro = $this->transformarDataBancoParaDataBr($cliente->DataCadastro);
        }
        
        return view('listar-clientes', compact('clientes'));
    }

    public function detalhar($idCliente){
        $cliente = ClientesModel::orderBy('RazaoSocial');
        $cliente->where('IdCliente', '=', $idCliente);
        $cliente = $cliente->first();
        
        $cliente->DataCadastro = $this->transformarDataBancoParaDataBr($cliente->DataCadastro);

        $contatosCliente = ContatosClientesModel::orderBy('TipoContato');
        $contatosCliente->where('IdCliente', '=', $idCliente);
        $contatosCliente = $contatosCliente->paginate(15);

        return view('detalhar-cliente', compact('cliente', 'contatosCliente'));
    }

    public function editar(Request $request){
        $dados = $request->all();

        $clienteAlterado = ClientesModel::orderBy('RazaoSocial');
        $clienteAlterado->where('IdCliente', '=', $dados['idCliente']);
        $clienteAlterado->update(['RazaoSocial' => $dados['razaoSocial'], 'BolAtivo' => $dados['ativo']]);

        return redirect('listar-clientes')->with('sucesso', 'Cliente ' . $dados['razaoSocial'] . ' (ID: ' . $dados['idCliente'] . ') alterado com sucesso!');
    }

    public function excluir(Request $request){
        $dados = $request->all();

        $clienteAlterado = ClientesModel::orderBy('RazaoSocial');
        $clienteAlterado->where('IdCliente', '=', $dados['idCliente']);
        $clienteAlterado->update(['BolAtivo' => '0']);

        return redirect('listar-clientes')->with('sucesso', 'Cliente ' . $dados['razaoSocial'] . ' (ID: ' . $dados['idCliente'] . ') excluído com sucesso!');
    }

    public function cadastrar(Request $request){
        $cliente = ClientesModel::orderBy('RazaoSocial');
        $cliente->insert(['RazaoSocial' => $request->razaoSocial, 'DataCadastro' => date('Y-m-d'), 'BolAtivo' => '1']);

        return redirect('listar-clientes')->with('sucesso', 'Cliente cadastrado com sucesso!');
    }

    public function procurar(Request $request){
    	
        if ($request->razaoSocial == null){
            $request->razaoSocial = 'todos';
        }

        return redirect()->route('mostrarClientes', ['razaoSocial' => $request->razaoSocial]);
    }

    public function mostrarClientes($razaoSocial){
        $clientes = ClientesModel::orderBy('RazaoSocial');
        
        if ($razaoSocial == 'todos'){
            $clientes = $clientes->paginate(15);

            foreach($clientes as $cliente){
                $cliente->DataCadastro = $this->transformarDataBancoParaDataBr($cliente->DataCadastro);
            }
            
            return view('listar-clientes', compact('clientes'));
        }

        $arrayPalavras = explode(' ', $razaoSocial);

        foreach ($arrayPalavras as $palavra) {
            $clientes->where('razaoSocial', 'like', '%' . $palavra . '%');
        }   

        $clientes = $clientes->paginate(15);
        

        if($clientes->isEmpty()){
            return redirect('listar-clientes')->with('message', 'Nenhum Cliente encontrado.');
        }

        foreach($clientes as $cliente){
            $cliente->DataCadastro = $this->transformarDataBancoParaDataBr($cliente->DataCadastro);
        }

        return view ('listar-clientes', compact('clientes'));
    }

    public function transformarDataBancoParaDataBr($data){
        return date('d/m/Y', strtotime($data));
    }

    public function transformarDataBrParaDataBanco($data){
        return date('Y-m-d', strtotime($data));
    }
}
