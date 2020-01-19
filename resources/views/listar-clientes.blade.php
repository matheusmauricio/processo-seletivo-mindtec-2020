<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Clientes</title>

    @include('includes.css')

    <style>
        .botao-tabela{
            text-align: center;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="modal fade" tabindex="-1" role="dialog" id="spinner-loader">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <span class="fa fa-spinner fa-spin fa-3x w-100"></span>
            </div>
        </div>


        <h1 style="text-align: center">Listagem de Clientes</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pesquisar Cliente</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="/procurar-cliente">
                            @csrf
                            <div class="form-group row">
                                <label for="razaoSocialLabel" class="col-md-4 col-form-label text-md-right">Razão Social</label>

                                <div class="col-md-6">
                                    <input id="razaoSocial" type="text" class="form-control" name="razaoSocial" placeholder="Razão Social do Cliente">
                                </div>
                                <button type="submit" class="btn btn-primary">Procurar</button>
                            </div>

                            <!-- Erro -->
                            @if(session()->has('message'))
                                <br>
                                <div class="form-group row mb-0 alert alert-danger" style="font-size:20px;">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <!--Fim erro-->

                            <!-- Sucesso -->
                            @if(session()->has('sucesso'))
                                <br>
                                <div class="form-group row mb-0 alert alert-success" style="font-size:20px">
                                    {{ session()->get('sucesso') }}
                                </div>
                            @endif
                            <!--Fim sucesso-->

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row justify-content-center resp">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Resultado <a role="button" class="btn btn-success btn-sm" href="cadastrar-cliente" style="float:right;"><i class="fas fa-file" style="text-align: center;"></i></a></div>
                    <table id="tabela" class="table table-bordered table-striped" summary="Resultado da pesquisa">
                        <thead>
                            <tr>
                                <th scope='col' style='vertical-align:middle'>Razão Social</th>
                                <th scope='col' style='vertical-align:middle'>Data do Cadastro</th>
                                <th scope='col' style='vertical-align:middle'>Ativo</th>
                                <th scope='col' style='vertical-align:middle'>Editar</th>
                                <th scope='col' style='vertical-align:middle'>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente) 
                                <tr>
                                    @if($cliente->BolAtivo == '0')
                                        <td style="color: red">{{ $cliente->RazaoSocial }}</td>
                                        <td style="color: red">{{ $cliente->DataCadastro }}</td>
                                        <td style="color: red">{{ $cliente->BolAtivo }}</td>
                                        <td class="botao-tabela"><a role="button" class="btn btn-warning btn-sm" href="/detalhar-cliente/{{ $cliente->IdCliente }}"><i class="fas fa-edit" style="text-align: center"></i></a></td>
                                        <td class="botao-tabela"></td>
                                    @else
                                        <td>{{ $cliente->RazaoSocial }}</td>
                                        <td>{{ $cliente->DataCadastro }}</td>
                                        <td>{{ $cliente->BolAtivo }}</td>
                                        <td class="botao-tabela"><a role="button" class="btn btn-warning btn-sm" href="/detalhar-cliente/{{ $cliente->IdCliente }}"><i class="fas fa-edit" style="text-align: center"></i></a></td>
                                        <td class="botao-tabela"><button type="button" class="btn btn-danger btn-sm" data-toggle='modal' data-target='#modalConfirmar{{ $cliente->IdCliente }}'><i class="fas fa-trash" style="text-align: center"></i></button></td>
                                    @endif
                                </tr>

                                {{-- Modal Confirmar Exclusão --}}
                                <div id='modalConfirmar{{ $cliente->IdCliente }}' class='modal fade' role='dialog'>
                                    <div class='modal-dialog'>
                                        {{-- Conteúdo do Modal --}}
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h4 class='modal-title'>Confirmar Exclusão</h4>
                                            </div>
                                            <div class='modal-body'>
                                                <p>Deseja mesmo desativar esse cliente?</p>
                                            </div>
                                            <div class='modal-footer'>
                                                <form method="POST" id="idForm" action="/excluir-cliente" enctype="multipart/form-data" data-toggle="validator" role="form">
                                                    @csrf
                                                    <input id="idCliente" type="hidden" class="form-control" name="idCliente" value='{{$cliente->IdCliente}}'>
                                                    <input id="razaoSocial" type="hidden" class="form-control" name="razaoSocial" value='{{$cliente->RazaoSocial}}'>
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
                <span style="float: right; margin-top: 5px">{{$clientes->links()}}</span>
            </div>
        </div>

    </div>

    @include('includes.javascript')

    <script>
        $(document).ready(function() {

            setInterval(function(){
                $.ajax({
                    type: "get",
                    url: "#",
                    success:function(data){
                        modal();

                        location.reload();
                    }
                });
            }, 30000);

            function modal(){
                $('#spinner-loader').modal('show');
                setTimeout(function () {
                    console.log('hejsan');
                    $('#spinner-loader').modal('hide');
                }, 3000);
            }

        });

    </script>

</body>
</html>