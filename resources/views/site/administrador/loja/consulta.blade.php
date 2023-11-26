@extends('site/administrador/menu')
@section('title', 'Duociclo - Lojas')

@section('conteudo')

        <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Lojas</h1>
              <span class="right chip">{{$totalLojas}} lojas cadastradas</span>  
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
                <a id="openModalBtnIncluir" href="#modalIncluirLoja" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/administrador/loja/incluir') 

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaLoja') }}" method="GET">
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
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($lojas as $loja)
                    @include('site/administrador/loja/visualizar', ['loja' => $loja])
                    @include('site/administrador/loja/alterar', ['loja' => $loja])
                    @include('site/administrador/loja/excluir', ['loja' => $loja])
                    <tr>
                        <td>{{$loja->lojcodigo}}</td>
                        <td>{{$loja->lojnome}}</td>
                        <td>{{$loja->lojcnpj}}</td>
                        <td>{{$loja->lojtelefone}}</td>
                        <td>{{$loja->lojemail}}</td>
                        <td>{{$loja->lojcep}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-loja-id="{{ $loja->lojcodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content seuBotaoDeExclusao" data-loja-id="{{ $loja->lojcodigo }}" style="position: relative; bottom:0px;" title="Excluir">
                                <i class="material-icons">delete</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-loja-id="{{ $loja->lojcodigo }}">
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
            var lojas = @json($lojas).data; // Converter a variável PHP $lojas em um array JavaScript

            $(document).ready(function() {
                //INCLUIR
                var modalIncluirLoja = $('#modalIncluirLoja').modal();
                $("#openModalBtnIncluir").click(function() {
                    modalIncluirLoja.modal("open");
                    $('.error-message').remove();
                    limparCamposModalIncluir();
                    limparClassesCampos();
                });

                modalIncluirLoja.modal({
                    dismissible: false
                });''

                function limparCamposModalIncluir() {
                    $('#lojnome').val('');
                    $('#lojcnpj').val('');
                    $('#lojnumeroendereco').val('');
                    $('#lojtelefone').val('');
                    $('#lojemail').val('');
                    $('#lojcep').val('');
                    $('#lojrua').val('');
                    $('#lojbairro').val('');
                    $('#lojcidade').val('');
                    $('#lojestado').val('');
                    $('#lojcomplementoendereco').val('');
                };

                function limparClassesCampos() {
                    $('#lojnome')[0].className = 'validate';
                    $('#lojcnpj')[0].className = 'validate';
                    $('#lojnumeroendereco')[0].className = 'validate';
                    $('#lojtelefone')[0].className = 'validate';
                    $('#lojemail')[0].className = 'validate';
                    $('#lojcep')[0].className = 'validate';
                    $('#lojrua')[0].className = 'validate';
                    $('#lojbairro')[0].className = 'validate';
                    $('#lojcidade')[0].className = 'validate';
                    $('#lojcomplementoendereco')[0].className = 'validate';
                };

                $("#btnFecharIncluir").click(function() {
                    limparCamposModalIncluir();
                });
                
                $('#btnEnviarFormIncluir').click(function(event){
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var lojnome = $('#modalIncluirLoja #lojnome').val().trim();
                    var lojcnpj = $('#modalIncluirLoja #lojcnpj').val().trim();
                    var lojcep = $('#modalIncluirLoja #lojcep').val().trim();
                    var lojrua = $('#modalIncluirLoja #lojrua_aux').val().trim();
                    var lojbairro = $('#modalIncluirLoja #lojbairro_aux').val().trim();
                    var lojcidade = $('#modalIncluirLoja #lojcidade_aux').val().trim();
                    var lojestado = $('#modalIncluirLoja select[name="lojestado_aux"]').val().trim();
                    var lojnumeroendereco = $('#modalIncluirLoja #lojnumeroendereco').val().trim();

                    var data = {
                        lojnome: lojnome,
                        lojcnpj: lojcnpj,
                        lojtelefone: $('#modalIncluirLoja #lojtelefone').val().trim(),
                        lojcep: lojcep,
                        lojrua:lojrua,
                        lojbairro:lojbairro,
                        lojcidade:lojcidade,
                        lojestado: lojestado,
                        lojnumeroendereco: lojnumeroendereco,
                        lojcomplementoendereco: $('#modalIncluirLoja #lojcomplementoendereco').val().trim()
                        // ... (outros campos)
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/administrador/lojas/validaInclusaoLoja',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                                $('#modalIncluirLoja #lojrua').val($('#modalIncluirLoja #lojrua_aux').val());
                                $('#modalIncluirLoja #lojbairro').val($('#modalIncluirLoja #lojbairro_aux').val());
                                $('#modalIncluirLoja #lojcidade').val($('#modalIncluirLoja #lojcidade_aux').val());
                                $('#modalIncluirLoja #lojestado').val($('#modalIncluirLoja select[name="lojestado_aux"]').val());
                                $('#formIncluirLoja').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirLoja #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalIncluirLoja #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });

                //VISUALIZAR
                $('.seuBotaoDeVisualizacao').click(function() {
                    var modalVisualizarLoja = $('#modalVisualizarLoja').modal();
                    modalVisualizarLoja[0].style.maxHeight = '100%';
                    var lojcodigo = $(this).data('loja-id'); // Obtém o ID da loja do atributo data-loja-id
                    var loja = encontrarLojaPorId(lojcodigo); // Encontra a loja correspondente no array de lojas
                    preencherModalVisualizar(loja); // Preenche o modal de visualização com os dados da loja
                    modalVisualizarLoja.modal('open');
                });

                function encontrarLojaPorId(id) {
                    return lojas.find(function(loja) {
                        return loja.lojcodigo === id;
                    });
                };

                // Função para preencher o modal de visualização com os dados da loja
                function preencherModalVisualizar(loja) {
                    $('#modalVisualizarLoja .modal-content').html('');
                    $('#modalVisualizarLoja .modal-content').append('<h4 class="center">Visualizar</h4>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Nome da Loja:</b> ' + loja.lojnome + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>CNPJ:</b> ' + loja.lojcnpj + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Telefone:</b> ' + loja.lojtelefone + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>E-mail:</b> ' + loja.lojemail + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>CEP:</b> ' + loja.lojcep + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Rua:</b> ' + loja.lojrua + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Bairro:</b> ' + loja.lojbairro + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Cidade:</b> ' + loja.lojcidade + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Estado:</b> ' + loja.lojestado + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>N° Endereço:</b> ' + loja.lojnumeroendereco + '</p>');
                    $('#modalVisualizarLoja .modal-content').append('<p><b>Complemento Endereço:</b> ' + loja.lojcomplementoendereco + '</p>');
                };

                //ALTERAR/
                $('.seuBotaoDeAlteracao').click(function() {
                    var lojcodigo = $(this).data('loja-id'); 
                    var loja = encontrarLojaPorId(lojcodigo);
                    var modalAlterarLoja = $('#modalAlterarLoja_' + lojcodigo).modal();
                    
                    carregaCep(loja);
                    preencherFormularioDeAlteracao(loja);
                    $('.error-message').remove();
                    limparClassesCampos();
                    modalAlterarLoja.modal('open');
                });

                function preencherFormularioDeAlteracao(loja) {
                    var lojcodigo = loja.lojcodigo; 
                    $('#modalAlterarLoja_' + lojcodigo +' #lojcodigo').val(loja.lojcodigo);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojnome').val(loja.lojnome);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojcnpj').val(loja.lojcnpj);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojnumeroendereco').val(loja.lojnumeroendereco);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojtelefone').val(loja.lojtelefone);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojemail').val(loja.lojemail);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojcep').val(loja.lojcep);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojrua_aux').val(loja.lojrua);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojbairro_aux').val(loja.lojbairro);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojcidade_aux').val(loja.lojcidade);
                    $('#modalAlterarLoja_' + lojcodigo +' select[name="lojestado_aux"]').val(loja.lojestado);
                    $('#modalAlterarLoja_' + lojcodigo +' #lojcomplementoendereco').val(loja.lojcomplementoendereco);
                    // Preencha os outros campos conforme necessário
                };

                function carregaCep(loja){
                    var lojcodigo = loja.lojcodigo; 
                    var cep = $('#modalAlterarLoja_' + lojcodigo +' #lojcep').val();

                        $.ajax({
                            url: '/obter-endereco-por-cep',
                            method: 'POST',
                            data: { cep: cep },
                            success: function (response) {
                                if (response.data.erro !== true) {
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojrua_aux').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojbairro_aux').val(response.data.bairro).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojcidade_aux').val(response.data.localidade).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarLoja_' + lojcodigo +' select[name="lojestado_aux"]').val(response.data.uf).addClass('filled').prop('disabled', true);
                                
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojrua"]').addClass('active');
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojbairro"]').addClass('active');
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojcidade"]').addClass('active');

                                } else{
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojrua_aux').val(loja.lojrua).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojbairro_aux').val(loja.lojbairro).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarLoja_' + lojcodigo +' #lojcidade_aux').val(loja.lojcidade).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarLoja_' + lojcodigo +' select[name="lojestado_aux"]').val(loja.lojestado).addClass('filled').prop('disabled', false);
                                
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojrua"]').addClass('active');
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojbairro"]').addClass('active');
                                    $('#modalAlterarLoja_' + lojcodigo +' label[for="lojcidade"]').addClass('active');
                                
                                }
                            },
                            error: function (error) {
                                console.error(error);
                                // Lidar com erros aqui
                            }
                        });
                };

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                // Adicione um manipulador de eventos para fechar o modal quando o formulário for enviado com sucesso
                $('#btnEnviarFormAlteracao').click(function() {
                    var lojcodigo = +$('#lojcodigo').val(); 
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var lojnome = $('#modalAlterarLoja_' + lojcodigo +' #lojnome').val().trim();
                    var lojcnpj = $('#modalAlterarLoja_' + lojcodigo +' #lojcnpj').val().trim();
                    var lojcep = $('#modalAlterarLoja_' + lojcodigo +' #lojcep').val().trim();
                    var lojrua = $('#modalAlterarLoja_' + lojcodigo +' #lojrua_aux').val().trim();
                    var lojbairro = $('#modalAlterarLoja_' + lojcodigo +' #lojbairro_aux').val().trim();
                    var lojcidade = $('#modalAlterarLoja_' + lojcodigo +' #lojcidade_aux').val().trim();
                    var lojestado = $('#modalAlterarLoja_' + lojcodigo +' select[name="lojestado_aux"]').val().trim();
                    var lojnumeroendereco = $('#modalAlterarLoja_' + lojcodigo +' #lojnumeroendereco').val().trim();

                    // Dados para enviar no AJAX
                    var data = {
                        lojcodigo: $('#modalAlterarLoja_' + lojcodigo +' #lojcodigo').val().trim(),
                        lojnome: lojnome,
                        lojcnpj: lojcnpj,
                        lojtelefone: $('#modalAlterarLoja_' + lojcodigo +' #lojtelefone').val().trim(),
                        lojcep: lojcep,
                        lojrua:lojrua,
                        lojbairro:lojbairro,
                        lojcidade:lojcidade,
                        lojestado: lojestado,
                        lojnumeroendereco: lojnumeroendereco,
                        lojcomplementoendereco: $('#modalAlterarLoja_' + lojcodigo +' #lojcomplementoendereco').val().trim()
                        // ... (outros campos)
                    };

                    

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/administrador/lojas/validaAlteracaoLoja',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                                $('#modalAlterarLoja_' + lojcodigo + ' #lojrua').val($('#modalAlterarLoja_' + lojcodigo + ' #lojrua_aux').val());
                                $('#modalAlterarLoja_' + lojcodigo + ' #lojbairro').val($('#modalAlterarLoja_' + lojcodigo + ' #lojbairro_aux').val());
                                $('#modalAlterarLoja_' + lojcodigo + ' #lojcidade').val($('#modalAlterarLoja_' + lojcodigo + ' #lojcidade_aux').val());
                                $('#modalAlterarLoja_' + lojcodigo + ' #lojestado').val($('#modalAlterarLoja_' + lojcodigo + ' select[name="lojestado_aux"]').val());
                                $('#formAlterarLoja').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalAlterarLoja_' + lojcodigo + ' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalAlterarLoja_' + lojcodigo + ' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
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

                $('.seuBotaoDeExclusao').click(function() {
                    var lojcodigo = $(this).data('loja-id'); 
                    var loja = encontrarLojaPorId(lojcodigo);
                    var modalExcluirLoja = $('#modalExcluirLoja_' + lojcodigo).modal();
                    modalExcluirLoja.modal('open');
                });
            });
        </script>
        <div class="row center">
            {{$lojas->links('custom/pagination')}}
        </div>
    </div>
    
@endsection