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
                    <input placeholder="Pesquisar..." id="search" type="search" name="search" value="{{ $search }}">
                  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form>
            </div>
          </nav>     

            <div class="card z-depth-4 registros" >
            <table class="striped ">
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
                    <tr>
                        <td><img src="{{ asset('storage/' . $veiculo->veiimagem) }}"></td>
                        <td>{{$veiculo->veicodigo}}</td>
                        <td>{{$veiculo->veidescricao}}</td>
                        <td>{{$veiculo->veicor}}</td>
                        <td>{{$veiculo->veiano}}</td>
                        <td>{{$veiculo->veiquilometragem}}</td>
                        <td>{{$veiculo->veiplaca}}</td>
                        <td>{{$veiculo->veisituacao}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-veiculo-id="{{ $veiculo->veicodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <form action="{{ route('excluirVeiculo', ['id' => $veiculo->veicodigo]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $veiculo->veicodigo }}">
                                <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content" title="Excluir" style="position: relative; bottom:0px;"><i class="material-icons">delete</i></button>
                            </form>
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
                var marcas   = @json($marcas);

                $(document).ready(function() {
                    //INCLUIR
                    var modalIncluirVeiculo = $('#modalIncluirVeiculo').modal();
                    modalIncluirVeiculo[0].style.maxHeight = '100%';
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirVeiculo.modal("open");
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                    });
        
                    modalIncluirVeiculo.modal({
                        dismissible: false
                    });
                    
                    function limparCamposModalIncluir() {
                        $('#marnome').val('');
                    };
        
                    function limparClassesCampos() {
                        $('#marnome')[0].className = 'validate';
                    };
                    
                    $("#btnFecharIncluir").click(function() {
                        limparCamposModalIncluir();
                    });
                    
                    //VISUALIZAR
                    var modalVisualizarVeiculo = $('#modalVisualizarVeiculo').modal();
                    modalVisualizarVeiculo[0].style.maxHeight = '100%';
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
                        var marca = encontrarMarcaPorId(veiculo.marcodigo);
                        var sDescricaoMarca = 'Sem marca vinculada!';
                        $('#modalVisualizarVeiculo .modal-content').append('<h4 class="center">Visualizar</h4>');
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
                        modalAlterarVeiculo[0].style.maxHeight = '100%';
                        preencherFormularioDeAlteracao(veiculo);
                        modalAlterarVeiculo.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                    function preencherFormularioDeAlteracao(veiculo) {
                        $('#modalAlterarVeiculo #veicodigo').val(veiculo.veicodigo);
                        $('#modalAlterarVeiculo #veiquilometragem').val(veiculo.veiquilometragem);
                        $('#modalAlterarVeiculo #veiplaca').val(veiculo.veiplaca);
                        $('#modalAlterarVeiculo #veicor').val(veiculo.veicor);
                        $('#modalAlterarVeiculo #veidescricao').val(veiculo.veidescricao);
                    };

                    $('#btnEnviarFormAlteracao').click(function() {
                        event.preventDefault();
                        $('#formAlterarVeiculo').submit();
                    });

                });
        
            </script>
            <div class="row center">
                {{$veiculos->links('custom/pagination')}}
            </div>              
    </div>

@endsection