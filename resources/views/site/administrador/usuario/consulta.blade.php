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
                    @include('site/administrador/usuario/excluir', ['usuario' => $usuario])
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
                            <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content seuBotaoDeExclusao" title="Excluir" style="position: relative; bottom:0px;" data-usuario-id="{{ $usuario->id }}"><i class="material-icons">delete</i></button>
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
                    $('#usucomplementoendereco')[0].className = 'validate';
                    $('#usudatanascimento')[0].className = 'validate';
                };

                $("#btnFecharIncluir").click(function() {
                    limparCamposModalIncluir();
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

                $('.seuBotaoDeExclusao').click(function() {
                    debugger;
                    var usucodigo = $(this).data('usuario-id'); 
                    var modalExcluirUsuario = $('#modalExcluirUsuario_' + usucodigo).modal();
                    modalExcluirUsuario.modal('open');
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