<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do Contato do Cliente</title>

    @include('includes.css')

</head>
<body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Detalhes do Contato do Cliente</div>
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            <form method="POST" id="idForm" action="/editar-contato" enctype="multipart/form-data" data-toggle="validator" role="form">
                                @csrf
    
                                <div class="form-group row">
                                    <label for="tipoContatoLabel" class="col-md-4 col-form-label text-md-right">Tipo de Contato</label>
    
                                    <div class="col-md-6">
                                        <input id="tipoContato" type="text" class="form-control" name="tipoContato" value='{{$contatoCliente->TipoContato}}' placeholder="Digite o Tipo de Contato." required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="descContatoLabel" class="col-md-4 col-form-label text-md-right">Descrição do Contato</label>
    
                                    <div class="col-md-6">
                                        <input id="descContato" type="text" class="form-control" name="descContato" value='{{$contatoCliente->DescContato}}' placeholder="Digite a Descrição do Contato." required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ativoLabel" class="col-md-4 col-form-label text-md-right">Ativo</label>
    
                                    <div class="col-md-6">
                                        <input id="ativo" type="text" class="form-control" name="ativo" value='{{$contatoCliente->BolAtivo}}' placeholder="Ativo" required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>

                                <input id="idContato" type="hidden" class="form-control" name="idContato" value='{{$contatoCliente->IdContato}}'>

                                <input id="idCliente" type="hidden" class="form-control" name="idCliente" value='{{$contatoCliente->IdCliente}}'>
    
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
        </div>

        @include('includes.javascript')
</body>
</html>