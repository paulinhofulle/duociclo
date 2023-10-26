@extends('site/lojista/menu')
@section('title', 'Duociclo - Planos')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Planos</h1>
              <span class="right chip">{{$totalPlanos}} planos cadastrados</span>  
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
                <a id="openModalBtnIncluir" href="#modalIncluirPlano" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/lojista/cadastro/plano/incluir')

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaPlano') }}" method="GET">
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
                    <th>ID</th>  
                    <th>Descrição</th>
                    <th>Qtde Dias</th>
                    <th>Valor</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($planos as $plano)
                    @include('site/lojista/cadastro/plano/visualizar', ['plano' => $plano])
                    @include('site/lojista/cadastro/plano/alterar', ['plano' => $plano])
                    <tr>
                        <td>{{$plano->placodigo}}</td>
                        <td>{{$plano->pladescricao}}</td>
                        <td>{{$plano->plaquantidadedias}}</td>
                        <td>R${{str_replace('.', ',', $plano->plavalor)}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-plano-id="{{ $plano->placodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <form action="{{ route('excluirPlano', ['id' => $plano->placodigo]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $plano->placodigo }}">
                                <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content" title="Excluir" style="position: relative; bottom:0px;"><i class="material-icons">delete</i></button>
                            </form>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-plano-id="{{ $plano->placodigo }}">
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
                var planos = @json($planos).data;

                $(document).ready(function() {
                    //INCLUIR
                    var modalIncluirPlano = $('#modalIncluirPlano').modal();
                    modalIncluirPlano[0].style.maxHeight = '100%';
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirPlano.modal("open");
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                    });
        
                    modalIncluirPlano.modal({
                        dismissible: false
                    });
                    
                    function limparCamposModalIncluir() {
                        $('#pladescricao').val('');
                        $('#plaquantidadedias').val('');
                        $('#plavalor').val('');
                    };
        
                    function limparClassesCampos() {
                        $('#pladescricao')[0].className = 'validate';
                        $('#plaquantidadedias')[0].className = 'validate';
                        $('#plavalor')[0].className = 'validate';
                    };
                    
                    $("#btnFecharIncluir").click(function() {
                        limparCamposModalIncluir();
                    });
                    
                    //VISUALIZAR
                    var modalVisualizarPlano = $('#modalVisualizarPlano').modal();
                    modalVisualizarPlano[0].style.maxHeight = '100%';
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var placodigo = $(this).data('plano-id'); // Obtém o ID da loja do atributo data-loja-id
                        var plano = encontrarPlanoPorId(placodigo); // Encontra a loja correspondente no array de lojas
                        preencherModalVisualizar(plano); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarPlano.modal('open');
                    });

                    function encontrarPlanoPorId(id) {
                        return planos.find(function(plano) {
                            return plano.placodigo === id;
                        });
                    };

                    function preencherModalVisualizar(plano) {
                        $('#modalVisualizarPlano .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarPlano .modal-content').append('<p><b>Descrição:</b> ' + plano.pladescricao + '</p>');
                        $('#modalVisualizarPlano .modal-content').append('<p><b>Quantidade de Dias:</b> ' + plano.plaquantidadedias + '</p>');
                        $('#modalVisualizarPlano .modal-content').append('<p><b>Valor:</b> R$' + plano.plavalor + '</p>');
                        $('#modalVisualizarPlano .modal-content').append('<p><b>Quantidade de Parcelas:</b> ' + plano.plaquantidadeparcela + '</p>');
                    };

                    //ALTERAR
                    $('.seuBotaoDeAlteracao').click(function() {
                        var placodigo = $(this).data('plano-id'); // Obtém o ID da loja do atributo data-loja-id
                        var plano = encontrarPlanoPorId(placodigo);
                        var modalAlterarPlano = $('#modalAlterarPlano_' + placodigo).modal();
                        modalAlterarPlano[0].style.maxHeight = '100%';
                        //preencherFormularioDeAlteracao(plano);
                        modalAlterarPlano.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                    function preencherFormularioDeAlteracao(veiculo) {
                        $('#modalAlterarVeiculo #veicodigo').val(veiculo.veicodigo);
                        $('#modalAlterarVeiculo #veikm').val(veiculo.veikm);
                        $('#modalAlterarVeiculo #veiplaca').val(veiculo.veiplaca);
                        $('#modalAlterarVeiculo #veicor').val(veiculo.veicor);
                        $('#modalAlterarVeiculo #veidescricao').val(veiculo.veidescricao);
                    };

                    $('#btnEnviarFormAlteracao').click(function() {
                        event.preventDefault();
                        $('#formAlterarPlano').submit();
                    });

                    Inputmask("currency", {
                        alias: "numeric",
                        radixPoint: ",",
                        groupSeparator: ".",
                        autoGroup: true,
                        digits: 2,
                        digitsOptional: false,
                        placeholder: "0",
                        rightAlign: false
                    }).mask("#plavalor");

                });
        
            </script>
            <div class="row center">
                {{$planos->links('custom/pagination')}}
            </div>              
    </div>

@endsection