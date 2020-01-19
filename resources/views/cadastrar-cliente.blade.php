<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Cliente</title>

    @include('includes.css')

</head>
<body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Cadastrar Cliente</div>
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            <form method="POST" id="idForm" action="/cadastrar-cliente" enctype="multipart/form-data" data-toggle="validator" role="form">
                                @csrf
    
                                <div class="form-group row">
                                    <label for="razaoSocialLabel" class="col-md-4 col-form-label text-md-right">Razão Social</label>
    
                                    <div class="col-md-6">
                                        <input id="razaoSocial" type="text" class="form-control" name="razaoSocial" value='' placeholder="Digite a Razão Social do cliente." required>
                                        <div class="help-block with-errors alert-danger" style="font-size: 14px; text-align: center; margin-top: 5px; border-radius: 5px; border-radius: 5px"></div>
                                    </div>
                                </div>
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
    
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