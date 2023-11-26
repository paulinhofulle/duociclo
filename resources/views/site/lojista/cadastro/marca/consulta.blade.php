@extends('site/lojista/menu')
@section('title', 'Duociclo - Marcas')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Marcas</h1>
              <span class="right chip">{{$totalMarcas}} marcas cadastradas</span>  
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
                <a id="openModalBtnIncluir" href="#modalIncluirMarca" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/lojista/cadastro/marca/incluir')

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaMarca') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar pelo Nome..." id="search" type="search" name="search" value="{{ $search }}">
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
                    <th>ID</th>  
                    <th>Nome</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($marcas as $marca)
                    @include('site/lojista/cadastro/marca/visualizar', ['marca' => $marca])
                    @include('site/lojista/cadastro/marca/alterar', ['marca' => $marca])
                    @include('site/lojista/cadastro/marca/excluir', ['marca' => $marca])
                    <tr>
                        <td>{{$marca->marcodigo}}</td>
                        <td>{{$marca->marnome}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-marca-id="{{ $marca->marcodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content btn modal-trigger seuBotaoDeExclusao" title="Excluir" style="position: relative; bottom:0px;" data-marca-id="{{ $marca->marcodigo }}"><i class="material-icons">delete</i></button>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-marca-id="{{ $marca->marcodigo }}">
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
                var marcas = @json($marcas).data;

                $(document).ready(function() {
                    //INCLUIR
                    var modalIncluirMarca = $('#modalIncluirMarca').modal();
                    modalIncluirMarca[0].style.maxHeight = '100%';
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirMarca.modal("open");
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                    });
        
                    modalIncluirMarca.modal({
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
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var modalVisualizarMarca = $('#modalVisualizarMarca').modal();
                        var marcodigo = $(this).data('marca-id'); // Obtém o ID da loja do atributo data-loja-id
                        var marca = encontrarMarcaPorId(+marcodigo); // Encontra a loja correspondente no array de lojas
                        preencherModalVisualizar(marca); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarMarca.modal('open');
                    });

                    function encontrarMarcaPorId(id) {
                        return marcas.find(function(marca) {
                            return marca.marcodigo === id;
                        });
                    };

                    function preencherModalVisualizar(marca) {
                        var modalContent = $('#modalVisualizarMarca .modal-content');
    
                        // Limpar conteúdo anterior
                        modalContent.empty();
                        $('#modalVisualizarMarca .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarMarca .modal-content').append('<p><b>Nome:</b> ' + marca.marnome + '</p>');
                    };

                    //ALTERAR
                    $('.seuBotaoDeAlteracao').click(function() {
                        var marcodigo = $(this).data('marca-id'); // Obtém o ID da loja do atributo data-loja-id
                        var marca = encontrarMarcaPorId(marcodigo);
                        var modalAlterarMarca = $('#modalAlterarMarca_' + marcodigo).modal();
                        modalAlterarMarca[0].style.maxHeight = '100%';
                        preencherFormularioDeAlteracao(marca);
                        modalAlterarMarca.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                    function preencherFormularioDeAlteracao(marca) {
                        $('#modalAlterarMarca #marcodigo').val(marca.marcodigo);
                        $('#modalAlterarMarca #marnome').val(marca.marnome);
                    };

                    $('#btnEnviarFormAlteracao').click(function() {
                        event.preventDefault(); // Evite o envio do formulário padrão
                        $('#formAlterarMarca').submit();
                    });

                    $('.seuBotaoDeExclusao').click(function() {
                    var marcodigo = $(this).data('marca-id'); 
                    var modalExcluirMarca = $('#modalExcluirMarca_' + marcodigo).modal();
                    modalExcluirMarca.modal('open');
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Inicialize os modais
                    var elems = document.querySelectorAll('.modal');
                    var instances = M.Modal.init(elems, options);

                    // Inicialize os seletores
                    var selectElems = document.querySelectorAll('select');
                    var selectInstances = M.FormSelect.init(selectElems);
                });
                // Or with jQuery

                $(document).ready(function(){
                    $('select').formSelect();
                });
            });
        
            </script>
            <div class="row center">
                {{$marcas->links('custom/pagination')}}
            </div>              
    </div>

@endsection