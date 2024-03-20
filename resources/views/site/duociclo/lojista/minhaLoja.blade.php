@extends('site/lojista/menu')
@section('title', 'Duociclo - Minha Loja')

@section('conteudo')
<div class="container">
    <form id="formAlterarMinhaLoja" class="col s12 m8 offset-m2" action="{{ route('alterarMinhaLoja', ['id' => old('lojcodigo', $loja->lojcodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="lojcodigo" name="lojcodigo" value="{{ old('lojcodigo', $loja->lojcodigo) }}">
            <h4 class="center">Minha Loja</h4>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnome" type="text" class="validate" name="lojnome" value="{{ old('lojnome', $loja->lojnome) }}" disabled readonly>
                    <label for="lojnome">Nome da Loja</label>
                    @error('lojnome')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojcnpj" type="number" class="validate" name="lojcnpj" value="{{ old('lojcnpj', $loja->lojcnpj) }}" disabled readonly>
                    <label for="lojcnpj">CNPJ</label>
                    @error('lojcnpj')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojtelefone" type="tel" class="validate" name="lojtelefone" value="{{ old('lojtelefone', $loja->lojtelefone) }}" placeholder="XX XXXXX-XXXX" required>
                    <label for="lojtelefone">Telefone</label>
                    @error('lojtelefone')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojemail" type="email" class="validate" name="lojemail" value="{{ old('lojemail', $loja->lojemail) }}" required>
                    <label for="lojemail">E-mail</label>
                    @error('lojemail')
                        <span class="text-danger"  style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-field">
                <input id="lojcep" type="number" class="validate" name="lojcep" placeholder="00000-000" value="{{ old('lojcep', $loja->lojcep) }}" required>
                <label for="lojcep">CEP</label>
                @error('lojcep')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojrua_aux" type="text" class="validate" name="lojrua_aux" value="{{ old('lojrua', $loja->lojrua) }}">
                    <input type="hidden" id="lojrua" name="lojrua" value="">
                    <label for="lojrua">Rua</label>
                    @error('lojrua')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojbairro_aux" type="text" class="validate" name="lojbairro_aux" value="{{ old('lojbairro', $loja->lojbairro) }}">
                    <input type="hidden" id="lojbairro" name="lojbairro" value="">
                    <label for="lojbairro">Bairro</label>
                    @error('lojbairro')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojcidade_aux" type="text" class="validate" name="lojcidade_aux" value="{{ old('lojcidade', $loja->lojcidade) }}">
                    <input type="hidden" id="lojcidade" name="lojcidade" value="">
                    <label for="lojcidade">Cidade</label>
                    @error('lojcidade')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <label for="lojestado">Estado</label>
                    <br>
                    <br>
                    <input type="hidden" id="lojestado" name="lojestado" value="">
                    <select name="lojestado_aux" class="validate browser-default" required>
                        <option value="" {{ old('lojestado', $loja->lojestado) ? '' : 'selected' }}>Selecione...</option>
                        <option value="AC" {{ old('lojestado', $loja->lojestado) == 'AC' ? 'selected' : '' }}>Acre</option>
                        <option value="AL" {{ old('lojestado', $loja->lojestado) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                        <option value="AP" {{ old('lojestado', $loja->lojestado) == 'AP' ? 'selected' : '' }}>Amapá</option>
                        <option value="AM" {{ old('lojestado', $loja->lojestado) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                        <option value="BA" {{ old('lojestado', $loja->lojestado) == 'BA' ? 'selected' : '' }}>Bahia</option>
                        <option value="CE" {{ old('lojestado', $loja->lojestado) == 'CE' ? 'selected' : '' }}>Ceará</option>
                        <option value="DF" {{ old('lojestado', $loja->lojestado) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                        <option value="ES" {{ old('lojestado', $loja->lojestado) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                        <option value="GO" {{ old('lojestado', $loja->lojestado) == 'GO' ? 'selected' : '' }}>Goiás</option>
                        <option value="MA" {{ old('lojestado', $loja->lojestado) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                        <option value="MT" {{ old('lojestado', $loja->lojestado) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                        <option value="MS" {{ old('lojestado', $loja->lojestado) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                        <option value="MG" {{ old('lojestado', $loja->lojestado) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                        <option value="PA" {{ old('lojestado', $loja->lojestado) == 'PA' ? 'selected' : '' }}>Pará</option>
                        <option value="PB" {{ old('lojestado', $loja->lojestado) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                        <option value="PR" {{ old('lojestado', $loja->lojestado) == 'PR' ? 'selected' : '' }}>Paraná</option>
                        <option value="PE" {{ old('lojestado', $loja->lojestado) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                        <option value="PI" {{ old('lojestado', $loja->lojestado) == 'PI' ? 'selected' : '' }}>Piauí</option>
                        <option value="RJ" {{ old('lojestado', $loja->lojestado) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                        <option value="RN" {{ old('lojestado', $loja->lojestado) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                        <option value="RS" {{ old('lojestado', $loja->lojestado) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                        <option value="RO" {{ old('lojestado', $loja->lojestado) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                        <option value="RR" {{ old('lojestado', $loja->lojestado) == 'RR' ? 'selected' : '' }}>Roraima</option>
                        <option value="SC" {{ old('lojestado', $loja->lojestado) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                        <option value="SP" {{ old('lojestado', $loja->lojestado) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                        <option value="SE" {{ old('lojestado', $loja->lojestado) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                        <option value="TO" {{ old('lojestado', $loja->lojestado) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                    </select>
                    @error('lojestado')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnumeroendereco" type="number" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                    <label for="lojnumeroendereco">N° Endereço</label>
                    @error('lojnumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojcomplementoendereco" type="text" class="validate" name="lojcomplementoendereco" value="{{ old('lojcomplementoendereco', $loja->lojcomplementoendereco) }}">
                    <label for="lojcomplementoendereco">Complemento Endereço</label>
                    @error('lojcomplementoendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
            <div class="row center">
                <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Função para obter endereço por CEP
        function obterEnderecoPorCep(loja) {
            var cep = $('#lojcep').val();

            $.ajax({
                url: '/obter-endereco-por-cep',
                method: 'POST',
                data: { cep: cep },
                success: function (response) {
                    if (response.data.erro !== true) {
                        $('#lojrua_aux').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                        $('#lojbairro_aux').val(response.data.bairro).addClass('filled').prop('disabled', true);
                        $('#lojcidade_aux').val(response.data.localidade).addClass('filled').prop('disabled', true);
                        $('select[name="lojestado_aux"]').val(response.data.uf).addClass('filled').prop('disabled', true);
                    } else {
                        $('#lojrua_aux').val(loja.lojrua).removeClass('filled').prop('disabled', false);
                        $('#lojbairro_aux').val(loja.lojbairro).removeClass('filled').prop('disabled', false);
                        $('#lojcidade_aux').val(loja.lojcidade).removeClass('filled').prop('disabled', false);
                        $('select[name="lojestado_aux"]').val(loja.lojestado).removeClass('filled').prop('disabled', false);
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
            var loja = @json($loja); 
            obterEnderecoPorCep(loja);

            // Adicionar evento de 'blur' ao campo CEP
            $('#lojcep').on('blur', function () {
                obterEnderecoPorCep(loja);
            });

            $('#formAlterarMinhaLoja').on('submit', function () {
                // Definir o valor de #lojrua com o valor de #lojrua_aux antes de enviar o formulário
                $('#lojrua').val($('#lojrua_aux').val());
                $('#lojbairro').val($('#lojbairro_aux').val());
                $('#lojcidade').val($('#lojcidade_aux').val());
                $('#lojestado').val($('select[name="lojestado_aux"]').val());
            });
        });
    </script>
@endsection