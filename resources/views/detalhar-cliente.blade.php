<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Detalhes do Cliente {{ $cliente->RazaoSocial }}</title>

        @include('includes.css')

        <style>
            .botao-tabela{
                text-align: center;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Detalhes do Cliente <b>{{ $cliente->RazaoSocial }}</b></div>
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            <form method="POST" id="idForm" action="/editar-cliente" enctype="multipart/form-data" data-toggle="validator" role="form">
                                @csrf
    
                                <div class="form-group row">
                                    <label for="razaoSocialLabel" class="col-md-4 col-form-label text-md-right">Nome</label>
    
                                    <div class="col-md-6">
                                        <input id="razaoSocial" type="text" class="form-control" name="razaoSocial" value='{{$cliente->RazaoSocial}}' placeholder="Digite a Razão Social do cliente." required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="dataCadastroLabel" class="col-md-4 col-form-label text-md-right">Data do Cadastro</label>
    
                                    <div class="col-md-6">
                                        <input id="dataCadastro" type="text" class="form-control" name="dataCadastro" value='{{$cliente->DataCadastro}}' placeholder="" readonly>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="ativoLabel" class="col-md-4 col-form-label text-md-right">Ativo</label>
    
                                    <div class="col-md-6">
                                        <input id="ativo" type="text" class="form-control" name="ativo" value='{{$cliente->BolAtivo}}' placeholder="Ativo" required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>
    
                                <input id="idCliente" type="hidden" class="form-control" name="idCliente" value='{{$cliente->IdCliente}}'>
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Editar</button>
    
                                        <button type="button" class="btn btn-primary" style="float: right" id="buttonVoltar">Voltar</button>
    
                                    </div>
                                </div>
    
                                <!-- Erro -->
                                @if(session()->has('message'))
                                    <br>
                                    <div class="form-group row mb-0 alert alert-danger" style="font-size:20px">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <!--Fim erro-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row justify-content-center resp">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Contatos <a role="button" class="btn btn-success btn-sm" href="/cadastrar-contato-cliente/{{ $cliente->IdCliente }}" style="float:right;"><i class="fas fa-file" style="text-align: center;"></i></a></div>
                        <table id="tabela" class="table table-bordered table-striped" summary="Resultado da pesquisa">
                            <thead>
                                <tr>
                                    <th scope='col' style='vertical-align:middle'>Tipo de Contato</th>
                                    <th scope='col' style='vertical-align:middle'>Descrição</th>
                                    <th scope='col' style='vertical-align:middle'>Ativo</th>
                                    <th scope='col' style='vertical-align:middle'>Editar</th>
                                    <th scope='col' style='vertical-align:middle'>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contatosCliente as $contato)
                                    <tr>
                                        @if($contato->BolAtivo == '0')
                                            <td style="color: red">{{ $contato->TipoContato }}</td>
                                            <td style="color: red">{{ $contato->DescContato  }}</td>
                                            <td style="color: red">{{ $contato->BolAtivo }}</td>
                                            <td class="botao-tabela"><a role="button" class="btn btn-warning btn-sm" href="/detalhar-contato-cliente/{{ $contato->IdContato }}"><i class="fas fa-edit" style="text-align: center"></i></a></td>
                                            <td class="botao-tabela"></td>
                                        @else
                                            <td>{{ $contato->TipoContato }}</td>
                                            <td>{{ $contato->DescContato  }}</td>
                                            <td>{{ $contato->BolAtivo }}</td>
                                            <td class="botao-tabela"><a role="button" class="btn btn-warning btn-sm" href="/detalhar-contato-cliente/{{ $contato->IdContato }}"><i class="fas fa-edit" style="text-align: center"></i></a></td>
                                            <td class="botao-tabela"><button type="button" class="btn btn-danger btn-sm" data-toggle='modal' data-target='#modalConfirmar{{ $contato->IdContato }}'><i class="fas fa-trash" style="text-align: center"></i></button></td>
                                        @endif
                                    </tr>

                                    {{-- Modal Confirmar Exclusão --}}
                                    <div id='modalConfirmar{{ $contato->IdContato }}' class='modal fade' role='dialog'>
                                        <div class='modal-dialog'>
                                            {{-- Conteúdo do Modal --}}
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h4 class='modal-title'>Confirmar Exclusão</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Deseja mesmo desativar esse contato?</p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <form method="POST" id="idForm" action="/excluir-contato" enctype="multipart/form-data" data-toggle="validator" role="form">
                                                        @csrf
                                                        <input id="idContato" type="hidden" class="form-control" name="idContato" value='{{$contato->IdContato}}'>
                                                        <input id="idCliente" type="hidden" class="form-control" name="idCliente" value='{{$contato->IdCliente}}'>
                                                        <button type="submit" class='btn btn-primary'>Sim</button>
                                                    </form>
                                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <span style="float: right; margin-top: 5px">{{$contatosCliente->links()}}</span>
                </div>
            </div>

        @include('includes.javascript')
    </body>
</html>