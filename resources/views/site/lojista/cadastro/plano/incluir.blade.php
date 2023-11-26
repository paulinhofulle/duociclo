<div id="modalIncluirPlano" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirPlano" action="{{ route('incluirPlano') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="pladescricao" type="text" class="validate" name="pladescricao" required>
                <label for="pladescricao">Descrição</label>
                @error('pladescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadedias" type="number" class="validate" name="plaquantidadedias" required>
                <label for="plaquantidadedias">Quantidade de Dias</label>
                @error('plaquantidadedias')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plavalor" type="text" class="validate" name="plavalor" placeholder="0,00" required>
                <label for="plavalor">Valor</label>
                @error('plavalor')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadeparcela" type="number" class="validate" name="plaquantidadeparcela" required>
                <label for="plaquantidadeparcela">Quantidade de Parcelas</label>
                @error('plaquantidadeparcela')
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
                    var pladescricao = $('#modalIncluirPlano #pladescricao').val().trim();
                    var plaquantidadedias = $('#modalIncluirPlano #plaquantidadedias').val().trim();
                    var plavalor = $('#modalIncluirPlano #plavalor').val().trim();
                    var plaquantidadeparcela = $('#modalIncluirPlano #plaquantidadeparcela').val().trim();
                    
                    var data = {
                        pladescricao: pladescricao,
                        plaquantidadedias: plaquantidadedias,
                        plavalor: plavalor,
                        plaquantidadeparcela:plaquantidadeparcela,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/lojista/planos/validaInclusaoPlano',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#formIncluirPlano').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirPlano #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalIncluirPlano #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });
    });
    </script>    