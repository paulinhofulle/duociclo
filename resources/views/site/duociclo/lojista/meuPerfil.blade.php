@extends('site/lojista/menu')
@section('title', 'Duociclo - Meu Perfil')

@section('conteudo')
<div class="container">
    <form id="formAlterarMeuPerfil" class="col s12 m8 offset-m2" action="{{ route('alterarMeuPerfilLojista', ['id' => old('id', $usuario->id)]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id" value="{{ old('id', $usuario->id) }}">
        <h4 class="center">Meu Perfil</h4>

        <div class="row">
            <div class="input-field col s12 m12">
                <input id="usunome" type="text" class="validate" name="usunome" value="{{ old('usunome', $usuario->usunome) }}" disabled readonly>
                <label for="usunome">Nome</label>
                @error('usunome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="usucpf" type="text" class="validate" name="usucpf" value="{{ old('usucpf', $usuario->usucpf) }}" disabled readonly>
                <label for="usucpf">CPF</label>
                @error('usucpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
                <input id="email" type="email" class="validate" name="email" value="{{ old('email', $usuario->email) }}" disabled readonly>
                <label for="email">E-mail</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <input id="usutelefone" type="tel" class="validate" name="usutelefone" value="{{ old('usutelefone', $usuario->usutelefone) }}" placeholder="XX XXXXX-XXXX" required>
                <label for="usutelefone">Telefone</label>
                @error('usutelefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
                <input id="usudatanascimento" type="date" class="validate" name="usudatanascimento" value="{{ old('usudatanascimento', $usuario->usudatanascimento) }}" disabled readonly>
                <label for="usudatanascimento">Data de Nascimento</label>
                @error('usudatanascimento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m12">
                <input id="usucep" type="number" class="validate" name="usucep" pattern="[0-9]{9}" maxlength="9" value="{{ old('usucep', $usuario->usucep) }}" placeholder="00000-000" required>
                <label for="usucep">CEP</label>
                @error('usucep')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input type="text" class="form-control" id="usurua_aux" name="usurua" value="{{ old('usucep', $usuario->usurua) }}" required>
                <input type="hidden" id="usurua" name="usurua" value="">
                <label for="usurua">Rua</label>
                @error('usurua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
                <input type="text" class="form-control" id="usubairro_aux" name="usubairro" value="{{ old('usucep', $usuario->usubairro) }}" required>
                <input type="hidden" id="usubairro" name="usubairro" value="">
                <label for="usubairro">Bairro</label>
                @error('usubairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input type="text" class="form-control" id="usucidade_aux" name="usucidade" value="{{ old('usucep', $usuario->usucidade) }}" required>
                <input type="hidden" id="usucidade" name="usucidade" value="">
                <label for="usucidade">Cidade</label>
                @error('usucidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
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
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="usunumeroendereco" type="number" class="validate" name="usunumeroendereco" value="{{ old('usunumeroendereco', $usuario->usunumeroendereco) }}" required>
                <label for="usunumeroendereco">N° Endereço</label>
                @error('usunumeroendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
                <input id="usucomplementoendereco" type="text" class="validate" name="usucomplementoendereco" value="{{ old('usucomplementoendereco', $usuario->usucomplementoendereco) }}">
                <label for="usucomplementoendereco">Complemento Endereço</label>
                @error('usucomplementoendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m12">
                <input id="password" type="password" class="validate" name="password">
                <label for="password">Senha Atual</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="newpassword" type="password" class="validate" name="newpassword">
                <label for="newpassword">Nova Senha</label>
                @error('newpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m6">
                <input id="newpassword_confirmation" type="password" class="validate" name="newpassword_confirmation">
                <label for="newpassword_confirmation">Confirmar Nova Senha</label>
                @error('newpassword_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Outros campos do formulário -->

        <div class="row center">
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Função para obter endereço por CEP
        function obterEnderecoPorCep(usuario) {
            var cep = $('#usucep').val();

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
                    } else {
                        $('#usurua_aux').val(usuario.usurua).removeClass('filled').prop('disabled', false);
                        $('#usubairro_aux').val(usuario.usubairro).removeClass('filled').prop('disabled', false);
                        $('#usucidade_aux').val(usuario.usucidade).removeClass('filled').prop('disabled', false);
                        $('select[name="usuestado_aux"]').val(usuario.usuestado).removeClass('filled').prop('disabled', false);
                    }
                },
                error: function (error) {
                    console.error(error);
                    // Lidar com erros aqui
                }
            });
        }
        

        // Chamar a função no carregamento da página
        $(document).ready(function () {
            var usuario = @json($usuario); 
            obterEnderecoPorCep(usuario);

            // Adicionar evento de 'blur' ao campo CEP
            $('#usucep').on('blur', function () {
                obterEnderecoPorCep(usuario);
            });
            

            $('#formAlterarMeuPerfil').on('submit', function () {
                // Definir o valor de #usurua com o valor de #usurua_aux antes de enviar o formulário
                $('#usurua').val($('#usurua_aux').val());
                $('#usubairro').val($('#usubairro_aux').val());
                $('#usucidade').val($('#usucidade_aux').val());
                $('#usuestado').val($('select[name="usuestado_aux"]').val());
            });
        });
    </script>
@endsection