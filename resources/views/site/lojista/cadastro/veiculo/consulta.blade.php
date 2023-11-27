@extends('site/lojista/menu')
@section('title', 'Duociclo - Veículos')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Veículos</h1>
              <span class="right chip">{{$totalVeiculos}} veículos cadastrados</span>  
            </div>
            @if (session('sucesso'))
                <div class="card green">
                    <div class="card-content white-text alert alert-success">
                        <span class="card-title">Parabéns</span>
                        {{ session('sucesso') }}
                    </div>
                </div>
            @endif

            @if (session('erro'))
                <div class="card green">
                    <div class="card-content white-text alert alert-erro">
                        <span class="card-title">Erro</span>
                        {{ session('erro') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <a id="openModalBtnIncluir" href="#modalIncluirVeiculo" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/lojista/cadastro/veiculo/incluir')

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaVeiculo') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar pela Descrição..." id="search" type="search" name="search" value="{{ $search }}">
                  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form>
            </div>
          </nav>     

            <div class="card z-depth-4 registros" >
            <table class="striped responsive-table">
                <thead>
                  <tr>
                    <th></th>  
                    <th>ID</th>  
                    <th>Descrição</th>
                    <th>Cor</th>
                    <th>Ano</th>
                    <th>KM</th>
                    <th>Placa</th>
                    <th>Situação</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($veiculos as $veiculo)
                    @include('site/lojista/cadastro/veiculo/visualizar', ['veiculo' => $veiculo])
                    @include('site/lojista/cadastro/veiculo/alterar', ['veiculo' => $veiculo])
                    @include('site/lojista/cadastro/veiculo/excluir', ['veiculo' => $veiculo])
                    <tr>
                        <td><img src="/img/veiculos/{{$veiculo->veiimagem}}" style="height: 3rem;"></td>
                        <td>{{$veiculo->veicodigo}}</td>
                        <td>{{$veiculo->veidescricao}}</td>
                        <td>{{$veiculo->veicor}}</td>
                        <td>{{$veiculo->veiano}}</td>
                        <td>{{$veiculo->veiquilometragem}}</td>
                        <td>{{$veiculo->veiplaca}}</td>
                        <td>{{$situacoes[$veiculo->veisituacao]}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-veiculo-id="{{ $veiculo->veicodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content btn modal-trigger seuBotaoDeExclusao" title="Excluir" style="position: relative; bottom:0px;" data-veiculo-id="{{ $veiculo->veicodigo }}"><i class="material-icons">delete</i></button>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-veiculo-id="{{ $veiculo->veicodigo }}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                        </td>
                    </tr>    
                  @endforeach
                </tbody>
              </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                var veiculos = @json($veiculos).data;
                var marcas   = Object.values(@json($marcas));

                $(document).ready(function() {
                    //INCLUIR
                    var modalIncluirVeiculo = $('#modalIncluirVeiculo').modal();
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirVeiculo.modal("open");
                        $('.error-message').remove();
                    });
        
                    modalIncluirVeiculo.modal({
                        dismissible: false
                    });
                    
                    function limparCamposModalIncluir() {
                        $('select[name="marcodigo"]').val('');
                    };
        
                    function limparClassesCampos() {
                        $('select[name="marcodigo"]')[0].className = 'validate';
                    };
                    
                    $("#btnFecharIncluir").click(function() {
                        limparCamposModalIncluir();
                    });
                    
                    //VISUALIZAR
                    var modalVisualizarVeiculo = $('#modalVisualizarVeiculo').modal();
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var veicodigo = $(this).data('veiculo-id'); // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo); // Encontra a loja correspondente no array de lojas
                        preencherModalVisualizar(veiculo); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarVeiculo.modal('open');
                    });

                    function encontrarVeiculoPorId(id) {
                        return veiculos.find(function(veiculo) {
                            return veiculo.veicodigo === id;
                        });
                    };

                    function encontrarMarcaPorId(id) {
                        return marcas.find(function(marca) {
                            return marca.marcodigo === id;
                        });
                    };

                    function preencherModalVisualizar(veiculo) {
                        var modalContent = $('#modalVisualizarVeiculo .modal-content');
    
                        // Limpar conteúdo anterior
                        modalContent.empty();

                        var marca = encontrarMarcaPorId(veiculo.marcodigo);
                        var sDescricaoMarca = 'Sem marca vinculada!';
                        $('#modalVisualizarVeiculo .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarVeiculo .modal-content').append('<img src="/img/veiculos/' + veiculo.veiimagem + '" alt="Imagem do Veículo" class="responsive-img">');
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>Descrição:</b> ' + veiculo.veidescricao + '</p>');
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>Cor:</b> ' + veiculo.veicor + '</p>');
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>Ano:</b> ' + veiculo.veiano + '</p>');
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>KM:</b> ' + veiculo.veiquilometragem + '</p>');
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>Placa:</b> ' + veiculo.veiplaca + '</p>');
                        if(marca){
                            sDescricaoMarca = marca.marcodigo + ' - ' + marca.marnome;
                        }
                        $('#modalVisualizarVeiculo .modal-content').append('<p><b>Marca:</b> ' + sDescricaoMarca + '</p>');
                    };

                    //ALTERAR
                    $('.seuBotaoDeAlteracao').click(function() {
                        var veicodigo = $(this).data('veiculo-id'); // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo);
                        var modalAlterarVeiculo = $('#modalAlterarVeiculo_' + veicodigo).modal();
                        preencherFormularioDeAlteracao(veiculo);
                        modalAlterarVeiculo.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                    function preencherFormularioDeAlteracao(veiculo) {
                        var veicodigo = veiculo.veicodigo;
                        $('#modalAlterarVeiculo_' + veicodigo+' #veicodigo').val(veiculo.veicodigo);
                        $('#modalAlterarVeiculo_' + veicodigo+' #veiquilometragem').val(veiculo.veiquilometragem);
                        $('#modalAlterarVeiculo_' + veicodigo+' #veiplaca').val(veiculo.veiplaca);
                        $('#modalAlterarVeiculo_' + veicodigo+' #veicor').val(veiculo.veicor);
                        $('#modalAlterarVeiculo_' + veicodigo+' #veidescricao').val(veiculo.veidescricao);
                    };

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $('#btnEnviarFormAlteracao').click(function() {
                        event.preventDefault(); // Evite o envio do formulário padrão
                        var veicodigo = +$('#veicodigo').val(); 
                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var veidescricao = $('#modalAlterarVeiculo_' + veicodigo+' #veidescricao').val().trim();
                    var veicor = $('#modalAlterarVeiculo_' + veicodigo+' #veicor').val().trim();
                    var veiano = $('#modalAlterarVeiculo_' + veicodigo+' #veiano').val().trim();
                    var marcodigo = $('#modalAlterarVeiculo_' + veicodigo+' select[name="marcodigo"]').val().trim();
                    
                    var data = {
                        veidescricao: veidescricao,
                        veicor: veicor,
                        veiano: veiano,
                        marcodigo:marcodigo,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/lojista/veiculos/validaAlteracaoVeiculo',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#formAlterarVeiculo').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalAlterarVeiculo_' + veicodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalAlterarVeiculo_' + veicodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                    });

                    $('.seuBotaoDeExclusao').click(function() {
                        var veicodigo = $(this).data('veiculo-id'); 
                        var modalExcluirVeiculo = $('#modalExcluirVeiculo_' + veicodigo).modal();
                        modalExcluirVeiculo.modal('open');
                    });

                });
        
            </script>
            <div class="row center">
                {{$veiculos->links('custom/pagination')}}
            </div>              
    </div>

@endsection