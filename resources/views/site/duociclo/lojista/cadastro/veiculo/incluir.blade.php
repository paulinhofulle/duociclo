<div id="modalIncluirVeiculo" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirVeiculo" action="{{ route('incluirVeiculo') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="file-field input-field">
                <div class="btn" style="background-color: #ff9800;">
                    <span>Imagem</span>
                    <input id="veiimagem" name="veiimagem" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field">
                <input id="veidescricao" type="text" class="validate" name="veidescricao">
                <label for="veidescricao">Descrição</label>
                @error('veidescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veicor" type="text" class="validate" name="veicor">
                <label for="veicor">Cor</label>
                @error('veinome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiano" type="number" class="validate" name="veiano" placeholder="XXXX" required>
                <label for="veiano">Ano</label>
                @error('veiano')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiquilometragem" type="number" class="validate" name="veiquilometragem" required>
                <label for="veiquilometragem">KM</label>
                @error('veiquilometragem')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiplaca" type="text" class="validate" name="veiplaca" required>
                <label for="veiplaca">Placa</label>
                @error('veiplaca')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Marca</label>
                <br>
                <br>
                <select name="marcodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione a marca...</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->marcodigo }}">{{ $marca->marnome }}</option>
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
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $('#btnEnviarFormIncluir').click(function(event){
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var veidescricao = $('#modalIncluirVeiculo #veidescricao').val().trim();
                    var veicor = $('#modalIncluirVeiculo #veicor').val().trim();
                    var veiano = $('#modalIncluirVeiculo #veiano').val().trim();
                    var marcodigo = $('#modalIncluirVeiculo select[name="marcodigo"]').val().trim();
                    
                    var data = {
                        veidescricao: veidescricao,
                        veicor: veicor,
                        veiano: veiano,
                        marcodigo:marcodigo,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/lojista/veiculos/validaInclusaoVeiculo',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#formIncluirVeiculo').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirVeiculo #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    if(key == 'marcodigo'){
                                        $('#modalIncluirVeiculo select[name="marcodigo"]').after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    } else{
                                        $('#modalIncluirVeiculo #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    
                                    }
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });
    });
    </script>    