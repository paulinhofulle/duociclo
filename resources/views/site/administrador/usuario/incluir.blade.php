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
                <input id="usurua" type="text" class="validate" name="usurua">
                <label for="usurua">Rua</label>
                @error('usurua')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usubairro" type="text" class="validate" name="usubairro">
                <label for="usubairro">Bairro</label>
                @error('usubairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucidade" type="text" class="validate" name="usucidade">
                <label for="usucidade">Cidade</label>
                @error('usucidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label for="usuestado">Estado</label>
                <br>
                <select name="usuestado" class="form-control" required>
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
                <select name="lojcodigo" class=" form-control validate" required>
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
                        $('#usurua').val(response.data.logradouro).addClass('filled').prop('disabled', true);
                        $('#usubairro').val(response.data.bairro).addClass('filled').prop('disabled', true);
                        $('#usucidade').val(response.data.localidade).addClass('filled').prop('disabled', true);
                        $('select[name="usuestado"]').val(response.data.uf).addClass('filled').prop('disabled', true);
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