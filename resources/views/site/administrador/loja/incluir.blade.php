<div id="modalIncluirLoja" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirLoja" action="{{ route('incluirLoja') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="lojnome" type="text" class="validate" name="lojnome" required>
                <label for="lojnome">Nome da Loja</label>
                @error('lojnome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcnpj" type="number" class="validate" name="lojcnpj" required>
                <label for="lojcnpj">CNPJ</label>
                @error('lojcnpj')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojtelefone" type="tel" class="validate" name="lojtelefone" placeholder="XX XXXXX-XXXX" required>
                <label for="lojtelefone">Telefone</label>
                @error('lojtelefone')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojemail" type="email" class="validate" name="lojemail" required>
                <label for="lojemail">E-mail</label>
                @error('lojemail')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcep" type="number" class="validate" name="lojcep" placeholder="00000-000" required>
                <label for="lojcep">CEP</label>
                @error('lojcep')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojrua" type="text" class="validate" name="lojrua">
                <label for="lojrua">Rua</label>
                @error('lojrua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojbairro" type="text" class="validate" name="lojbairro">
                <label for="lojbairro">Bairro</label>
                @error('lojbairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcidade" type="text" class="validate" name="lojcidade">
                <label for="lojcidade">Cidade</label>
                @error('lojcidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label for="lojestado">Estado</label>
                <br>
                <select name="lojestado" class="form-control" required>
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
                @error('lojestado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojnumeroendereco" type="number" class="validate" name="lojnumeroendereco" required>
                <label for="lojnumeroendereco">N° Endereço</label>
                @error('lojnumeroendereco')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcomplementoendereco" type="text" class="validate" name="lojcomplementoendereco">
                <label for="lojcomplementoendereco">Complemento Endereço</label>
                @error('lojcomplementoendereco')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
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
                        if (response.data) {
                            $('#lojrua').val(response.data.logradouro).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                            $('#lojbairro').val(response.data.bairro).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                            $('#lojcidade').val(response.data.localidade).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                            $('select[name="lojestado"]').val(response.data.uf).addClass('filled').prop('readonly', true).css({'color': 'rgba(0,0,0,0.42)','border-bottom': '1px dotted rgba(0,0,0,0.42)'});
                        } else{
                            $('#lojrua').val('').removeClass('filled').prop('readonly', false);
                            $('#lojbairro').val('').removeClass('filled').prop('readonly', false);
                            $('#lojcidade').val('').removeClass('filled').prop('readonly', false);
                            $('select[name="lojestado"]').val('').removeClass('filled').prop('readonly', false);
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