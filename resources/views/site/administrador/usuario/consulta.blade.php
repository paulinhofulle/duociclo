@extends('site/administrador/menu')
@section('title', 'Duociclo - Usuários')

@section('conteudo')

        <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Usuários</h1>
              <span class="right chip">{{$totalUsuarios}} usuários cadastrados</span>  
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
                <a id="openModalBtnIncluir" href="#modalIncluirUsuario" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/administrador/usuario/incluir')  

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaUsuario') }}" method="GET">
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
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>CEP</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($usuarios as $usuario)
                    @include('site/administrador/usuario/visualizar', ['usuario' => $usuario])
                    @include('site/administrador/usuario/alterar', ['usuario' => $usuario])
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->usunome}}</td>
                        <td>{{$usuario->usutelefone}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->usucep}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-usuario-id="{{ $usuario->id }}" style="position: relative; bottom:0px;" title="Alterar">
                                <i class="material-icons">build</i>
                            </button>
                            <form action="{{ route('excluirUsuario', ['id' => $usuario->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $usuario->id }}">
                                <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content" title="Excluir" style="position: relative; bottom:0px;"><i class="material-icons">delete</i></button>
                            </form>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-usuario-id="{{ $usuario->id }}">
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
            var lojas    = @json($lojas);
            var usuarios = @json($usuarios).data;

            $(document).ready(function() {
                //INCLUIR
                var modalIncluirUsuario = $('#modalIncluirUsuario').modal();
                $("#openModalBtnIncluir").click(function() {
                    modalIncluirUsuario.modal("open");
                    $('.error-message').remove();
                    limparCamposModalIncluir();
                    limparClassesCampos();
                });

                modalIncluirUsuario.modal({
                    dismissible: false
                });

                function limparCamposModalIncluir() {
                    $('#usunome').val('');
                    $('#usucpf').val('');
                    $('#usunumeroendereco').val('');
                    $('#usutelefone').val('');
                    $('#email').val('');
                    $('#usucep').val('');
                    $('#usurua').val('');
                    $('#usubairro').val('');
                    $('#usucidade').val('');
                    $('select[name="usuestado"]').val('');
                    $('#usucomplementoendereco').val('');
                    $('#usudatanascimento').val('');
                };

                function limparClassesCampos() {
                    $('#usunome')[0].className = 'validate';
                    $('#usucpf')[0].className = 'validate';
                    $('#usunumeroendereco')[0].className = 'validate';
                    $('#usutelefone')[0].className = 'validate';
                    $('#email')[0].className = 'validate';
                    $('#usucep')[0].className = 'validate';
                    $('#usurua')[0].className = 'validate';
                    $('#usubairro')[0].className = 'validate';
                    $('#usucidade')[0].className = 'validate';
                    $('#usuestado')[0].className = 'validate';
                    $('#usucomplementoendereco')[0].className = 'validate';
                    $('#usudatanascimento')[0].className = 'validate';
                };

                $("#btnFecharIncluir").click(function() {
                    limparCamposModalIncluir();
                });

                $('#btnEnviarFormIncluir').click(function(event){
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var usunome = $('#modalIncluirUsuario #usunome').val().trim();
                    var usucpf = $('#modalIncluirUsuario #usucpf').val().trim();
                    var usudatanascimento = $('#modalIncluirUsuario #usudatanascimento').val().trim();
                    var usutelefone = $('#modalIncluirUsuario #usutelefone').val().trim();
                    var email = $('#modalIncluirUsuario #email').val().trim();
                    var usucep = $('#modalIncluirUsuario #usucep').val().trim();
                    var usunumeroendereco = $('#modalIncluirUsuario #usunumeroendereco').val().trim();

                    var isValid = true; // Inicialmente, assume-se que o formulário é válido

                    // Validação do campo Nome
                    if (usunome === '') {
                        $('#modalIncluirUsuario #usunome').after('<span class="error-message" style="color:red;">O campo Nome é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usunome-error').remove();
                    }

                    // Validação do campo CPF
                    if (usucpf.length < 11 || isNaN(usucpf)) {
                        $('#modalIncluirUsuario #usucpf').after('<span class="error-message" style="color:red;">O campo CPF deve conter no mínimo 11 dígitos numéricos!</span>');
                        isValid = false;
                    } else {
                        $('#usucpf-error').remove();
                    }

                    // Validação do campo Data de Nascimento
                    if (usudatanascimento === '') {
                        $('#modalIncluirUsuario #usudatanascimento').after('<span class="error-message" style="color:red;">O campo Data de Nascimento é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usudatanascimento-error').remove();
                    }

                    // Validação do campo Telefone
                    if (usutelefone === '') {
                        $('#modalIncluirUsuario #usutelefone').after('<span class="error-message" style="color:red;">O campo Telefone é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usutelefone-error').remove();
                    }

                    // Validação do campo E-mail
                    if (email === '') {
                        $('#modalIncluirUsuario #email').after('<span class="error-message" style="color:red;">O campo E-mail é inválido!</span>');
                        isValid = false;
                    } else {
                        $('#email-error').remove();
                    }

                    // Validação do campo CEP
                    if (usucep.length !== 8 || isNaN(usucep)) {
                        $('#modalIncluirUsuario #usucep').after('<span class="error-message" style="color:red;">O campo CEP deve conter 8 dígitos numéricos!</span>');
                        isValid = false;
                    } else {
                        $('#usucep-error').remove();
                    }

                    // Validação do campo Número de Endereço
                    if (isNaN(usunumeroendereco)) {
                        $('#modalIncluirUsuario #usunumeroendereco').after('<span class="error-message" style="color:red;">O campo N° Endereço deve ser numérico!</span>');
                        isValid = false;
                    } else {
                        $('#usunumeroendereco-error').remove();
                    }

                    // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                    if (isValid) {
                        $('#formIncluirUsuario').submit();
                    } else {
                        M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                    }
                });
                
                //VISUALIZAR
                $('.seuBotaoDeVisualizacao').click(function() {
                    var modalVisualizarUsuario = $('#modalVisualizarUsuario').modal();
                    var usucodigo = $(this).data('usuario-id'); // Obtém o ID da loja do atributo data-loja-id
                    var usuario = encontrarUsuarioPorId(usucodigo); // Encontra a loja correspondente no array de lojas
                    preencherModalVisualizar(usuario); // Preenche o modal de visualização com os dados da loja
                    modalVisualizarUsuario.modal('open');
                });

                // Função para preencher o modal de visualização com os dados da loja
                function preencherModalVisualizar(usuario) {
                    var loja = encontrarLojaPorId(usuario.lojcodigo);
                    var sDescricaoLoja = 'Sem loja vinculada!';
                    $('#modalVisualizarUsuario .modal-content').html('');
                    $('#modalVisualizarUsuario .modal-content').append('<h4 class="center">Visualizar</h4>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Nome da Loja:</b> ' + usuario.usunome + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>CPF:</b> ' + usuario.usucpf + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Data de Nascimento:</b> ' + usuario.usudatanascimento + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Telefone:</b> ' + usuario.usutelefone + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>CEP:</b> ' + usuario.usucep + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Rua:</b> ' + usuario.usurua + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Bairro:</b> ' + usuario.usubairro + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Cidade:</b> ' + usuario.usucidade + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Estado:</b> ' + usuario.usuestado + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>N° Endereço:</b> ' + usuario.usunumeroendereco + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Complemento Endereço:</b> ' + usuario.usucomplementoendereco + '</p>');
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>E-mail:</b> ' + usuario.email + '</p>');
                    if(loja){
                        sDescricaoLoja = loja.lojcodigo + ' - ' + loja.lojnome;
                    }
                    $('#modalVisualizarUsuario .modal-content').append('<p><b>Loja:</b> ' + sDescricaoLoja + '</p>');
                };

                function encontrarUsuarioPorId(id) {
                    return usuarios.find(function(usuario) {
                        return usuario.id === id;
                    });
                };

                function encontrarLojaPorId(id) {
                    return lojas.find(function(loja) {
                        return loja.lojcodigo === id;
                    });
                };

                //ALTERAR
                $('.seuBotaoDeAlteracao').click(function() {
                    var usucodigo = $(this).data('usuario-id');
                    var usuario = encontrarUsuarioPorId(usucodigo);
                    var modalAlterarUsuario = $('#modalAlterarUsuario_' + usucodigo).modal();
                    preencherFormularioDeAlteracao(usuario);
                    modalAlterarUsuario.modal('open');
                    $('.error-message').remove();
                    limparClassesCampos();
                });

                function preencherFormularioDeAlteracao(usuario) {
                    $('#modalAlterarUsuario #id').val(usuario.id);
                    $('#modalAlterarUsuario #usunome').val(usuario.usunome);
                    $('#modalAlterarUsuario #usucpf').val(usuario.usucpf);
                    $('#modalAlterarUsuario #usunumeroendereco').val(usuario.usunumeroendereco);
                    $('#modalAlterarUsuario #usutelefone').val(usuario.usutelefone);
                    $('#modalAlterarUsuario #email').val(usuario.email);
                    $('#modalAlterarUsuario #usucep').val(usuario.usucep);
                    $('#modalAlterarUsuario #usucomplementoendereco').val(usuario.usucomplementoendereco);
                    $('#modalAlterarUsuario #usudatanascimento').val(usuario.usudatanascimento);
                    $('#modalAlterarUsuario #lojcodigo').val(usuario.lojcodigo);
                };

                $('#btnEnviarFormAlteracao').click(function(event) {
                    event.preventDefault();
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var usunome = $('#modalAlterarUsuario #usunome').val().trim();
                    var usucpf = $('#modalAlterarUsuario #usucpf').val().trim();
                    var usudatanascimento = $('#modalAlterarUsuario #usudatanascimento').val().trim();
                    var usutelefone = $('#modalAlterarUsuario #usutelefone').val().trim();
                    var email = $('#modalAlterarUsuario #email').val().trim();
                    var usucep = $('#modalAlterarUsuario #usucep').val().trim();
                    var usunumeroendereco = $('#modalAlterarUsuario #usunumeroendereco').val().trim();
                    var isValid = true; // Inicialmente, assume-se que o formulário é válido

                    // Validação do campo Nome
                    if (usunome === '') {
                        $('#modalAlterarUsuario #usunome').after('<span class="error-message" style="color:red;">O campo Nome é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usunome-error').remove();
                    }

                    // Validação do campo CPF
                    if (usucpf.length < 11 || isNaN(usucpf)) {
                        $('#modalAlterarUsuario #usucpf').after('<span class="error-message" style="color:red;">O campo CPF deve conter no mínimo 11 dígitos numéricos!</span>');
                        isValid = false;
                    } else {
                        $('#usucpf-error').remove();
                    }

                    // Validação do campo Data de Nascimento
                    if (usudatanascimento === '') {
                        $('#modalAlterarUsuario #usudatanascimento').after('<span class="error-message" style="color:red;">O campo Data de Nascimento é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usudatanascimento-error').remove();
                    }

                    // Validação do campo Telefone
                    if (usutelefone === '') {
                        $('#modalAlterarUsuario #usutelefone').after('<span class="error-message" style="color:red;">O campo Telefone é obrigatório!</span>');
                        isValid = false;
                    } else {
                        $('#usutelefone-error').remove();
                    }

                    // Validação do campo E-mail
                    if (email === '') {
                        $('#modalAlterarUsuario #email').after('<span class="error-message" style="color:red;">O campo E-mail é inválido!</span>');
                        isValid = false;
                    } else {
                        $('#email-error').remove();
                    }

                    // Validação do campo CEP
                    if (usucep.length !== 8 || isNaN(usucep)) {
                        $('#modalAlterarUsuario #usucep').after('<span class="error-message" style="color:red;">O campo CEP deve conter 8 dígitos numéricos!</span>');
                        isValid = false;
                    } else {
                        $('#usucep-error').remove();
                    }

                    // Validação do campo Número de Endereço
                    if (isNaN(usunumeroendereco)) {
                        $('#modalAlterarUsuario #usunumeroendereco').after('<span class="error-message" style="color:red;">O campo N° Endereço deve ser numérico!</span>');
                        isValid = false;
                    } else {
                        $('#usunumeroendereco-error').remove();
                    }

                    // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                    if (isValid) {
                        $('#formAlterarUsuario').submit();
                    } else {
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
    </div>
    
    <div class="row center">
        {{$usuarios->links('custom/pagination')}}
    </div>
    
@endsection