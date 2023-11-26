<div id="modalIncluirUsuario" class="modal">
    <div class="modal-content">
        <form id="formIncluirUsuario" action="{{ route('incluirUsuario') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="usunome" type="text" class="validate" name="usunome" required>
                <label for="usunome">Nome</label>
                @error('usunome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucpf" type="text" class="validate" name="usucpf" required>
                <label for="usucpf">CPF</label>
                @error('usucpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usudatanascimento" type="date" class="validate" name="usudatanascimento" required>
                <label for="usudatanascimento">Data de Nascimento</label>
                @error('usudatanascimento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usutelefone" type="tel" class="validate" name="usutelefone" placeholder="XX XXXXX-XXXX" required>
                <label for="usutelefone">Telefone</label>
                @error('usutelefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucep" type="number" class="validate" name="usucep" placeholder="00000-000" required>
                <label for="usucep">CEP</label>
                @error('usucep')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usurua_aux" name="usurua" required>
                <input type="hidden" id="usurua" name="usurua" value="">
                <label for="usurua">Rua</label>
                @error('usurua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usubairro_aux" name="usubairro" required>
                <input type="hidden" id="usubairro" name="usubairro" value="">
                <label for="usubairro">Bairro</label>
                @error('usubairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" class="form-control" id="usucidade_aux" name="usucidade" required>
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
                    <option value="" selected>Selecione...</option>
                    <!-- Lista de estados -->
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
                @error('usuestado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usunumeroendereco" type="number" class="validate" name="usunumeroendereco" required>
                <label for="usunumeroendereco">N° Endereço</label>
                @error('usunumeroendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucomplementoendereco" type="text" class="validate" name="usucomplementoendereco">
                <label for="usucomplementoendereco">Complemento Endereço</label>
                @error('usucomplementoendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="email" type="email" class="validate" name="email" required>
                <label for="email">E-mail</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label for="lojcodigo">Loja</label>
                <br>
                <br>
                <select name="lojcodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione a loja...</option>
                    @foreach ($lojas as $loja)
                        <option value="{{ $loja->lojcodigo }}">{{ $loja->lojnome }}</option>
                    @endforeach
                </select>
            </div>            
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
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
                    var usurua = $('#modalIncluirUsuario #usurua_aux').val().trim();
                    var usubairro = $('#modalIncluirUsuario #usubairro_aux').val().trim();
                    var usucidade = $('#modalIncluirUsuario #usucidade_aux').val().trim();
                    var usuestado = $('#modalIncluirUsuario select[name="usuestado_aux"]').val().trim();
                    var usunumeroendereco = $('#modalIncluirUsuario #usunumeroendereco').val().trim();
                    var lojcodigo = $('#modalIncluirUsuario select[name="lojcodigo"]').val().trim();

                    var data = {
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
                        url: '/administrador/usuarios/validaInclusaoUsuario',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                // Se todas as validações passarem, você pode fechar o modal e fazer o redirecionamento ou qualquer outra coisa que desejar
                                $('#modalIncluirUsuario #usurua').val($('#modalIncluirUsuario #usurua_aux').val());
                                $('#modalIncluirUsuario #usubairro').val($('#modalIncluirUsuario #usubairro_aux').val());
                                $('#modalIncluirUsuario #usucidade').val($('#modalIncluirUsuario #usucidade_aux').val());
                                $('#modalIncluirUsuario #usuestado').val($('#modalIncluirUsuario select[name="usuestado_aux"]').val());
                                $('#formIncluirUsuario').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirUsuario #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalIncluirUsuario #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });

            $('#usucep').on('blur', function() {
                var cep = $(this).val();

                $.ajax({
                    url: '/obter-endereco-por-cep',
                    method: 'POST',
                    data: { cep: cep },
                    success: function (response) {
                        if (response.data.erro !== true) {
                            $('#usurua_aux').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                            $('#usubairro_aux').val(response.data.bairro).addClass('filled').prop('disabled', true);
                            $('#usucidade_aux').val(response.data.localidade).addClass('filled').prop('disabled', true);
                            $('select[name="usuestado_aux"]').val(response.data.uf).addClass('filled').prop('disabled', true);
                        
                            $('label[for="usurua"]').addClass('active');
                            $('label[for="usubairro"]').addClass('active');
                            $('label[for="usucidade"]').addClass('active');
                        } else{
                            $('#usurua_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#usubairro_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#usucidade_aux').val('').removeClass('filled').prop('disabled', false);
                            $('select[name="usuestado_aux"]').val('').removeClass('filled').prop('disabled', false);
                        
                            $('label[for="usurua"]').addClass('active');
                            $('label[for="usubairro"]').addClass('active');
                            $('label[for="usucidade"]').addClass('active');
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