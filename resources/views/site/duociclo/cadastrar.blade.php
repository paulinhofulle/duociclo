@extends('site/duociclo/layoutLogin')
@section('title', 'Duociclo - Cadastrar-se')

@section('form')
    <form id="formCadastrar" action="{{route('registrar')}}" method="POST">
        @csrf
        <img src="imagens/duociclo_logo.png" alt="Duociclo" style="margin-bottom:-3rem; margin-left:-2.75rem" height="200" width="200">
        <h1 class="h3 mb-3 fw-normal">Cadastrar-se</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usunome" name="usunome" required>
                    <label for="usunome">Nome</label>
                    @error('usunome')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="usucpf" name="usucpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
                    <label for="usucpf">CPF</label>
                    @error('usucpf')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="usudatanascimento" name="usudatanascimento" required>
                    <label for="usudatanascimento">Data de Nascimento</label>
                    @error('usudatanascimento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="usutelefone" name="usutelefone" placeholder="(XX) XXXXX-XXXX" required>
                    <label for="usutelefone">Telefone</label>
                    @error('usutelefone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="email">E-mail</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usucep" name="usucep" placeholder="00000-000" required>
                    <label for="usucep">CEP</label>
                    @error('usucep')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usurua_aux" name="usurua" required>
                    <input type="hidden" id="usurua" name="usurua" value="">
                    <label for="usurua">Rua</label>
                    @error('usurua')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usubairro_aux" name="usubairro" required>
                    <input type="hidden" id="usubairro" name="usubairro" value="">
                    <label for="usubairro">Bairro</label>
                    @error('usubairro')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usucidade_aux" name="usucidade" required>
                    <input type="hidden" id="usucidade" name="usucidade" value="">
                    <label for="usucidade">Cidade</label>
                    @error('usucidade')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="hidden" id="usuestado" name="usuestado" value="">
                    <select name="usuestado_aux" class="form-control" required>
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
                    <label for="usuestado">Estado</label>
                    @error('usuestado')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="usunumeroendereco" name="usunumeroendereco" required>
                    <label for="usunumeroendereco">N° Endereço</label>
                    @error('usunumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usucomplemento" name="usucomplemento">
                    <label for="usucomplemento">Complemento</label>
                    @error('usucomplemento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                    <label for="password">Senha</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Senha" required>
                    <label for="password_confirmation">Confirmar Senha</label>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button id="btnCadastrar" class="btn btn-primary w-100 py-2" style="background-color: #e2a951; border-color:white; color:white">Cadastrar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
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
                        } else{
                            $('#usurua_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#usubairro_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#usucidade_aux').val('').removeClass('filled').prop('disabled', false);
                            $('select[name="usuestado_aux"]').val('').removeClass('filled').prop('disabled', false);

                        }
                    },
                    error: function (error) {
                        console.error(error);
                        // Lidar com erros aqui
                    }
                });
            });

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $('#btnCadastrar').click(function(event){
                event.preventDefault();
                debugger;
                var data = {
                        usunome: $('#usunome').val().trim(),
                        usucpf: $('#usucpf').val().trim(),
                        usudatanascimento: $('#usudatanascimento').val().trim(),
                        usutelefone: $('#usutelefone').val().trim(),
                        email:$('#email').val().trim(),
                        usucep:$('#usucep').val().trim(),
                        usurua:$('#usurua_aux').val().trim(),
                        usubairro: $('#usubairro_aux').val().trim(),
                        usucidade: $('#usucidade_aux').val().trim(),
                        usuestado: $('select[name="usuestado_aux"]').val().trim(),
                        usunumeroendereco: $('#usunumeroendereco').val().trim(),
                        usucomplemento: $('#usucomplemento').val().trim(),
                        password: $('#password').val().trim(),
                        password_confirmation: $('#password_confirmation').val().trim()
                        // ... (outros campos)
                    };
                $.ajax({
                        url: '/validaCadastro',
                        method: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            debugger;
                            if (response.isValid) {
                                $('#usurua').val($('#usurua_aux').val());
                                $('#usubairro').val($('#usubairro_aux').val());
                                $('#usucidade').val($('#usucidade_aux').val());
                                $('#usuestado').val($('select[name="usuestado_aux"]').val());
                                $('#formCadastrar').submit();
                            } else {
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $(key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {   
                            debugger;
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#'+key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            // Lidar com erros aqui
                        }
                    });
            });
        });
    </script>    
@endsection

@section('botaoAux')
<a href="{{ url('/') }}" class="btn btn-primary w-100 py-2" style="background-color: white; border-color:#e2a951; color:#e2a951">Voltar</a>
@endsection