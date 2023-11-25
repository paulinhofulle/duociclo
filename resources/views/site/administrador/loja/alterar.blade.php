<div id="modalAlterarLoja_{{$loja->lojcodigo}}" class="modal">
    <div class="modal-content">
        <!-- Formulário de edição da loja aqui -->
        <form id="formAlterarLoja" action="{{ route('alterarLoja', ['id' => old('lojcodigo', $loja->lojcodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="lojcodigo" name="lojcodigo" value="{{ old('lojcodigo', $loja->lojcodigo) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="lojnome" type="text" class="validate" name="lojnome" value="{{ old('lojnome', $loja->lojnome) }}" required>
                <label for="lojnome">Nome da Loja</label>
                @error('lojnome')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcnpj" type="number" class="validate" name="lojcnpj" value="{{ old('lojcnpj', $loja->lojcnpj) }}" required>
                <label for="lojcnpj">CNPJ</label>
                @error('lojcnpj')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojtelefone" type="tel" class="validate" name="lojtelefone" value="{{ old('lojtelefone', $loja->lojtelefone) }}" placeholder="XX XXXXX-XXXX" required>
                <label for="lojtelefone">Telefone</label>
                @error('lojtelefone')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojemail" type="email" class="validate" name="lojemail" value="{{ old('lojemail', $loja->lojemail) }}" required>
                <label for="lojemail">E-mail</label>
                @error('lojemail')
                    <span class="text-danger"  style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcep" type="number" class="validate" name="lojcep" placeholder="00000-000" value="{{ old('lojcep', $loja->lojcep) }}" required>
                <label for="lojcep">CEP</label>
                @error('lojcep')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojrua_aux" type="text" class="validate" name="lojrua_aux" value="{{ old('lojrua', $loja->lojrua) }}">
                <input type="hidden" id="lojrua" name="lojrua" value="">
                <label for="lojrua">Rua</label>
                @error('lojrua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojbairro_aux" type="text" class="validate" name="lojbairro_aux" value="{{ old('lojbairro', $loja->lojbairro) }}">
                <input type="hidden" id="lojbairro" name="lojbairro" value="">
                <label for="lojbairro">Bairro</label>
                @error('lojbairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcidade_aux" type="text" class="validate" name="lojcidade_aux" value="{{ old('lojcidade', $loja->lojcidade) }}">
                <input type="hidden" id="lojcidade" name="lojcidade" value="">
                <label for="lojcidade">Cidade</label>
                @error('lojcidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
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
            
            <div class="input-field">
                <input id="lojnumeroendereco" type="number" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                <label for="lojnumeroendereco">N° Endereço</label>
                @error('lojnumeroendereco')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcomplementoendereco" type="text" class="validate" name="lojcomplementoendereco" value="{{ old('lojcomplementoendereco', $loja->lojcomplementoendereco) }}">
                <label for="lojcomplementoendereco">Complemento Endereço</label>
                @error('lojcomplementoendereco')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lojcep').on('blur', function() {
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
                        if (response.data.erro !== true) {
                            $('#lojrua_aux').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                            $('#lojbairro_aux').val(response.data.bairro).addClass('filled').prop('disabled', true);
                            $('#lojcidade_aux').val(response.data.localidade).addClass('filled').prop('disabled', true);
                            $('select[name="lojestado_aux"]').val(response.data.uf).addClass('filled').prop('disabled', true);
                        
                            $('label[for="lojrua"]').addClass('active');
                            $('label[for="lojbairro"]').addClass('active');
                            $('label[for="lojcidade"]').addClass('active');

                        } else{
                            $('#lojrua_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#lojbairro_aux').val('').removeClass('filled').prop('disabled', false);
                            $('#lojcidade_aux').val('').removeClass('filled').prop('disabled', false);
                            $('select[name="lojestado_aux"]').val('').removeClass('filled').prop('disabled', false);
                        
                            $('label[for="lojrua"]').addClass('active');
                            $('label[for="lojbairro"]').addClass('active');
                            $('label[for="lojcidade"]').addClass('active');
                        
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