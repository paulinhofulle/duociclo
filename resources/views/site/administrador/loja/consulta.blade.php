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
            <table class="striped ">
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
                            <form action="{{ route('excluirLoja', ['id' => $loja->lojcodigo]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $loja->lojcodigo }}">
                                <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content" title="Excluir" style="position: relative; bottom:0px;"><i class="material-icons">delete</i></button>
                            </form>
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
                modalIncluirLoja[0].style.maxHeight = '100%';
                $("#openModalBtnIncluir").click(function() {
                    modalIncluirLoja.modal("open");
                    $('.error-message').remove();
                    limparCamposModalIncluir();
                    limparClassesCampos();
                });

                modalIncluirLoja.modal({
                    dismissible: false
                });

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
                    var lojnumeroendereco = $('#modalIncluirLoja #lojnumeroendereco').val().trim();

                    var isValid = true; // Inicialmente, assume-se que o formulário é válido

                    // Validação do campo Nome
                    if (lojnome === '') {
                        $('#modalIncluirLoja #lojnome').after('<span class="error-message" style="color:red;">O campo Nome é obrigatório!</span>');
                        isValid = false;
                    }else{
                        $('#lojnome-error').remove();
                    }

                    // Validação do campo CNPJ
                    if (lojcnpj.length !== 14 || isNaN(lojcnpj)) {
                        $('#modalIncluirLoja #lojcnpj').after('<span class="error-message" style="color:red;">O campo CNPJ deve conter 14 dígitos numéricos!</span>');
                        isValid = false;
                    }else{
                        $('#lojcnpj-error').remove();
                    }
                    
                    // Validação do campo CEP
                    if (lojcep.length !== 8 || isNaN(lojcep)) {
                        $('#modalIncluirLoja #lojcep').after('<span class="error-message" style="color:red;">O campo CEP deve conter 8 dígitos numéricos!</span>');
                        isValid = false;
                    }else{
                        $('#lojcep-error').remove();
                    }

                    // Validação do campo Número de Endereço
                    if (isNaN(lojnumeroendereco)) {
                        $('#modalIncluirLoja #lojnumeroendereco').after('<span class="error-message" style="color:red;">O campo N° Endereço deve ser numérico!</span>');
                        isValid = false;
                    }else{
                        $('#lojnumeroendereco-error').remove();
                    }

                    // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                    if (isValid) {
                        $('#formIncluirLoja').submit();
                    }else{
                        M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                    }
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
                    modalAlterarLoja[0].style.maxHeight = '100%';
                    preencherFormularioDeAlteracao(loja);
                    modalAlterarLoja.modal('open');
                    $('.error-message').remove();
                    limparClassesCampos();
                });

                function preencherFormularioDeAlteracao(loja) {
                    $('#modalAlterarLoja #lojcodigo').val(loja.lojcodigo);
                    $('#modalAlterarLoja #lojnome').val(loja.lojnome);
                    $('#modalAlterarLoja #lojcnpj').val(loja.lojcnpj);
                    $('#modalAlterarLoja #lojnumeroendereco').val(loja.lojnumeroendereco);
                    $('#modalAlterarLoja #lojtelefone').val(loja.lojtelefone);
                    $('#modalAlterarLoja #lojemail').val(loja.lojemail);
                    $('#modalAlterarLoja #lojcep').val(loja.lojcep);
                    $('#modalAlterarLoja #lojcomplementoendereco').val(loja.lojcomplementoendereco);
                    // Preencha os outros campos conforme necessário
                };

                // Adicione um manipulador de eventos para fechar o modal quando o formulário for enviado com sucesso
                $('#btnEnviarFormAlteracao').click(function() {
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var lojnome = $('#modalAlterarLoja #lojnome').val().trim();
                    var lojcnpj = $('#modalAlterarLoja #lojcnpj').val().trim();
                    var lojcep = $('#modalAlterarLoja #lojcep').val().trim();
                    var lojnumeroendereco = $('#modalAlterarLoja #lojnumeroendereco').val().trim();

                    var isValid = true; // Inicialmente, assume-se que o formulário é válido

                    // Validação do campo Nome
                    if (lojnome === '') {
                        $('#modalAlterarLoja #lojnome').after('<span class="error-message" style="color:red;">O campo Nome é obrigatório!</span>');
                        isValid = false;
                    }else{
                        $('#lojnome-error').remove();
                    }

                    // Validação do campo CNPJ
                    if (lojcnpj.length !== 14 || isNaN(lojcnpj)) {
                        $('#modalAlterarLoja #lojcnpj').after('<span class="error-message" style="color:red;">O campo CNPJ deve conter 14 dígitos numéricos!</span>');
                        isValid = false;
                    }else{
                        $('#lojcnpj-error').remove();
                    }
                    
                    // Validação do campo CEP
                    if (lojcep.length !== 8 || isNaN(lojcep)) {
                        $('#modalAlterarLoja #lojcep').after('<span class="error-message" style="color:red;">O campo CEP deve conter 8 dígitos numéricos!</span>');
                        isValid = false;
                    }else{
                        $('#lojcep-error').remove();
                    }

                    // Validação do campo Número de Endereço
                    if (isNaN(lojnumeroendereco)) {
                        $('#modalAlterarLoja #lojnumeroendereco').after('<span class="error-message" style="color:red;">O campo N° Endereço deve ser numérico!</span>');
                        isValid = false;
                    }else{
                        $('#lojnumeroendereco-error').remove();
                    }
                    
                    // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                    if (isValid) {
                        $('#formAlterarLoja').submit();
                    } else{
                        M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                    }
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
            {{$lojas->links('custom/pagination')}}
        </div>
    </div>
    
@endsection