<div id="modalAlterarUsuario_{{$usuario->id}}" class="modal">
    <div class="modal-content">
        <!-- Formulário de edição de usuario aqui -->
        <form id="formAlterarUsuario" action="{{ route('alterarUsuario', ['id' => old('id', $usuario->id)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="id" name="id" value="{{ old('id', $usuario->id) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="usunome" type="text" class="validate" name="usunome" value="{{ old('usunome', $usuario->usunome) }}" required>
                <label for="usunome">Nome</label>
                @error('usunome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucpf" type="text" class="validate" name="usucpf" value="{{ old('usucpf', $usuario->usucpf) }}" required>
                <label for="usucpf">CPF</label>
                @error('usucpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usudatanascimento" type="date" class="validate" name="usudatanascimento" value="{{ old('usudatanascimento', $usuario->usudatanascimento) }}" required>
                <label for="usudatanascimento">Data de Nascimento</label>
                @error('usudatanascimento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usutelefone" type="tel" class="validate" name="usutelefone" value="{{ old('usutelefone', $usuario->usutelefone) }}" placeholder="XX XXXXX-XXXX" required>
                <label for="usutelefone">Telefone</label>
                @error('usutelefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucep" type="number" class="validate" name="usucep" value="{{ old('usucep', $usuario->usucep) }}" placeholder="00000-000" required>
                <label for="usucep">CEP</label>
                @error('usucep')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usurua_aux" name="usurua" value="{{ old('usucep', $usuario->usurua) }}" required>
                <input type="hidden" id="usurua" name="usurua" value="">
                <label for="usurua">Rua</label>
                @error('usurua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usubairro_aux" name="usubairro" value="{{ old('usucep', $usuario->usubairro) }}" required>
                <input type="hidden" id="usubairro" name="usubairro" value="">
                <label for="usubairro">Bairro</label>
                @error('usubairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usucidade_aux" name="usucidade" value="{{ old('usucep', $usuario->usucidade) }}" required>
                <input type="hidden" id="usucidade" name="usucidade" value="">
                <label for="usucidade">Cidade</label>
                @error('usucidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label for="usuestado">Estado</label>
                <br>
                <br>
                <input type="hidden" id="usuestado" name="usuestado" value="">
                <select name="usuestado_aux" class="validate browser-default" required>
                    <option value="" {{ old('usuestado', $usuario->usuestado) ? '' : 'selected' }}>Selecione...</option>
                    <option value="AC" {{ old('usuestado', $usuario->usuestado) == 'AC' ? 'selected' : '' }}>Acre</option>
                    <option value="AL" {{ old('usuestado', $usuario->usuestado) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                    <option value="AP" {{ old('usuestado', $usuario->usuestado) == 'AP' ? 'selected' : '' }}>Amapá</option>
                    <option value="AM" {{ old('usuestado', $usuario->usuestado) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                    <option value="BA" {{ old('usuestado', $usuario->usuestado) == 'BA' ? 'selected' : '' }}>Bahia</option>
                    <option value="CE" {{ old('usuestado', $usuario->usuestado) == 'CE' ? 'selected' : '' }}>Ceará</option>
                    <option value="DF" {{ old('usuestado', $usuario->usuestado) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                    <option value="ES" {{ old('usuestado', $usuario->usuestado) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                    <option value="GO" {{ old('usuestado', $usuario->usuestado) == 'GO' ? 'selected' : '' }}>Goiás</option>
                    <option value="MA" {{ old('usuestado', $usuario->usuestado) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                    <option value="MT" {{ old('usuestado', $usuario->usuestado) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                    <option value="MS" {{ old('usuestado', $usuario->usuestado) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                    <option value="MG" {{ old('usuestado', $usuario->usuestado) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                    <option value="PA" {{ old('usuestado', $usuario->usuestado) == 'PA' ? 'selected' : '' }}>Pará</option>
                    <option value="PB" {{ old('usuestado', $usuario->usuestado) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                    <option value="PR" {{ old('usuestado', $usuario->usuestado) == 'PR' ? 'selected' : '' }}>Paraná</option>
                    <option value="PE" {{ old('usuestado', $usuario->usuestado) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                    <option value="PI" {{ old('usuestado', $usuario->usuestado) == 'PI' ? 'selected' : '' }}>Piauí</option>
                    <option value="RJ" {{ old('usuestado', $usuario->usuestado) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                    <option value="RN" {{ old('usuestado', $usuario->usuestado) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                    <option value="RS" {{ old('usuestado', $usuario->usuestado) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                    <option value="RO" {{ old('usuestado', $usuario->usuestado) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                    <option value="RR" {{ old('usuestado', $usuario->usuestado) == 'RR' ? 'selected' : '' }}>Roraima</option>
                    <option value="SC" {{ old('usuestado', $usuario->usuestado) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                    <option value="SP" {{ old('usuestado', $usuario->usuestado) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                    <option value="SE" {{ old('usuestado', $usuario->usuestado) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                    <option value="TO" {{ old('usuestado', $usuario->usuestado) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                </select>
                @error('usuestado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usunumeroendereco" type="number" class="validate" name="usunumeroendereco" value="{{ old('usunumeroendereco', $usuario->usunumeroendereco) }}" required>
                <label for="usunumeroendereco">N° Endereço</label>
                @error('usunumeroendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucomplementoendereco" type="text" class="validate" name="usucomplementoendereco" value="{{ old('usucomplementoendereco', $usuario->usucomplementoendereco) }}">
                <label for="usucomplementoendereco">Complemento Endereço</label>
                @error('usucomplementoendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="email" type="email" class="validate" name="email" value="{{ old('email', $usuario->email) }}" required>
                <label for="email">E-mail</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Loja</label>
                <br>
                <br>
                <select name="lojcodigo" id="lojcodigo" value="{{ old('lojcodigo', $usuario->lojcodigo) }}" class="validate browser-default" required>
                    <option value="" selected>Selecione a loja...</option>
                    @foreach ($lojas as $loja)
                    <option value="{{ $loja->lojcodigo }}" {{ $loja->lojcodigo == $usuario->lojcodigo ? 'selected' : '' }}>{{ $loja->lojnome }}</option>
                    @endforeach
                </select>
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange" data-usuario-id="{{ $usuario->id }}" >Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {

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
        
            $('.seuBotaoDeAlteracao').click(function() {
                    var usucodigo = $(this).data('usuario-id');
                    var usuario = encontrarUsuarioPorId(usucodigo);
                    var modalAlterarUsuario = $('#modalAlterarUsuario_' + usucodigo).modal();
                    carregaCep(usuario);
                    preencherFormularioDeAlteracao(usuario);
                    modalAlterarUsuario.modal('open');
                    $('.error-message').remove();
                    limparClassesCampos();
                });

                function preencherFormularioDeAlteracao(usuario) {
                    var usucodigo = usuario.id;
                    $('#modalAlterarUsuario_'+usucodigo+' #id').val(usuario.id);
                    $('#modalAlterarUsuario_'+usucodigo+' #usunome').val(usuario.usunome);
                    $('#modalAlterarUsuario_'+usucodigo+' #usucpf').val(usuario.usucpf);
                    $('#modalAlterarUsuario_'+usucodigo+' #usunumeroendereco').val(usuario.usunumeroendereco);
                    $('#modalAlterarUsuario_'+usucodigo+' #usutelefone').val(usuario.usutelefone);
                    $('#modalAlterarUsuario_'+usucodigo+' #email').val(usuario.email);
                    $('#modalAlterarUsuario_'+usucodigo+' #usucep').val(usuario.usucep);
                    $('#modalAlterarUsuario_'+usucodigo+' #usurua_aux').val(usuario.usurua);
                    $('#modalAlterarUsuario_'+usucodigo+' #usubairro_aux').val(usuario.usubairro);
                    $('#modalAlterarUsuario_'+usucodigo+' #usucidade_aux').val(usuario.usucidade);
                    $('#modalAlterarUsuario_'+usucodigo+' select[name="usuestado_aux"]').val(usuario.usucidade);
                    $('#modalAlterarUsuario_'+usucodigo+' #usucomplementoendereco').val(usuario.usucomplementoendereco);
                    $('#modalAlterarUsuario_'+usucodigo+' #usudatanascimento').val(usuario.usudatanascimento);
                    $('#modalAlterarUsuario_'+usucodigo+' #lojcodigo').val(usuario.lojcodigo);
                };

                function carregaCep(usuario){ 
                    var usucodigo = usuario.id;
                    var cep = $('#modalAlterarUsuario_' + usucodigo +' #usucep').val();

                        $.ajax({
                            url: '/obter-endereco-por-cep',
                            method: 'POST',
                            data: { cep: cep },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.data.erro !== true) {
                                    $('#modalAlterarUsuario_' + usucodigo +' #usurua_aux').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarUsuario_' + usucodigo +' #usubairro_aux').val(response.data.bairro).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarUsuario_' + usucodigo +' #usucidade_aux').val(response.data.localidade).addClass('filled').prop('disabled', true);
                                    $('#modalAlterarUsuario_' + usucodigo +' select[name="usuestado_aux"]').val(response.data.uf).addClass('filled').prop('disabled', true);
                                
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usurua"]').addClass('active');
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usubairro"]').addClass('active');
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usucidade"]').addClass('active');

                                } else{
                                    $('#modalAlterarUsuario_' + usucodigo +' #usurua_aux').val(usuario.usurua).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarUsuario_' + usucodigo +' #usubairro_aux').val(usuario.usubairro).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarUsuario_' + usucodigo +' #usucidade_aux').val(usuario.usucidade).addClass('filled').prop('disabled', false);
                                    $('#modalAlterarUsuario_' + usucodigo +' select[name="usuestado_aux"]').val(usuario.usuestado).addClass('filled').prop('disabled', false);
                                
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usurua"]').addClass('active');
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usubairro"]').addClass('active');
                                    $('#modalAlterarUsuario_' + usucodigo +' label[for="usucidade"]').addClass('active');
                                
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

                $('#btnEnviarFormAlteracao').click(function(event) {
                    var usucodigo = +$(this).data('usuario-id'); 
                    event.preventDefault();
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var usunome = $('#modalAlterarUsuario_' + usucodigo +' #usunome').val().trim();
                    var usucpf = $('#modalAlterarUsuario_' + usucodigo +' #usucpf').val().trim();
                    var usudatanascimento = $('#modalAlterarUsuario_' + usucodigo +' #usudatanascimento').val().trim();
                    var usutelefone = $('#modalAlterarUsuario_' + usucodigo +' #usutelefone').val().trim();
                    var email = $('#modalAlterarUsuario_' + usucodigo +' #email').val().trim();
                    var usucep = $('#modalAlterarUsuario_' + usucodigo +' #usucep').val().trim();
                    var usurua = $('#modalAlterarUsuario_' + usucodigo +' #usurua_aux').val().trim();
                    var usubairro = $('#modalAlterarUsuario_' + usucodigo +' #usubairro_aux').val().trim();
                    var usucidade = $('#modalAlterarUsuario_' + usucodigo +' #usucidade_aux').val().trim();
                    var usuestado = $('#modalAlterarUsuario_' + usucodigo +' select[name="usuestado_aux"]').val().trim();
                    var usunumeroendereco = $('#modalAlterarUsuario_' + usucodigo +' #usunumeroendereco').val().trim();
                    var lojcodigo = $('#modalAlterarUsuario_' + usucodigo +' #lojcodigo').val().trim();

                    // Dados para enviar no AJAX
                    var data = {
                        usucodigo: usucodigo,
                        usunome: usunome,
                        usucpf: usucpf,
                        usutelefone: usutelefone,
                        usudatanascimento: usudatanascimento,
                        email:email,
                        usucep:usucep,
                        usurua:usurua,
                        usubairro: usubairro,
                        usucidade: usucidade,
                        usuestado: usuestado,
                        usunumeroendereco: usunumeroendereco,
                        lojcodigo:lojcodigo
                        // ... (outros campos)
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/administrador/usuarios/validaAlteracaoUsuario',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                                $('#modalAlterarUsuario_' + usucodigo +' #usurua').val($('#modalAlterarUsuario_' + usucodigo +' #usurua_aux').val());
                                $('#modalAlterarUsuario_' + usucodigo +' #usubairro').val($('#modalAlterarUsuario_' + usucodigo +' #usubairro_aux').val());
                                $('#modalAlterarUsuario_' + usucodigo +' #usucidade').val($('#modalAlterarUsuario_' + usucodigo +' #usucidade_aux').val());
                                $('#modalAlterarUsuario_' + usucodigo +' #usuestado').val($('#modalAlterarUsuario_' + usucodigo +' select[name="usuestado_aux"]').val());
                                $('#formAlterarUsuario').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalAlterarUsuario_' + usucodigo +' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalAlterarUsuario_' + usucodigo +' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });


        $('#usucep').on('blur', function() {
            var cep = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/obter-endereco-por-cep',
                method: 'POST',
                data: { cep: cep },
                success: function (response) {
                    if (response.data) {
                        $('#usurua').val(response.data.logradouro).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                        $('#usubairro').val(response.data.bairro).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                        $('#usucidade').val(response.data.localidade).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                        $('select[name="usuestado"]').val(response.data.uf).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                    } else{
                        $('#usurua').val('').removeClass('filled').prop('disabled', false);
                        $('#usubairro').val('').removeClass('filled').prop('disabled', false);
                        $('#usucidade').val('').removeClass('filled').prop('disabled', false);
                        $('select[name="usuestado"]').val('').removeClass('filled').prop('disabled', false);
                    }
                },
                error: function (error) {
                    console.error(error);
                    // Lidar com erros aqui
                }
            });
        });
    });
    </script>    