<div id="modalIncluirReserva_{{$veiculo->veicodigo}}" class="modal">
    <div class="modal-content">
        <form id="formIncluirReserva" action="{{ route('incluirReserva') }}" method="POST">
            @csrf
            <h4 class="center">Solicitar</h4>
            <div class="input-field">
                <input id="veicodigo" type="hidden" class="validate" name="veicodigo">
                <input id="veidescricao" type="text" class="validate" name="veidescricao">
                <label for="veidescricao">Veículo</label>
                @error('veidescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label for="placodigo">Plano</label>
                <br>
                <br>
                <select id="placodigo" name="placodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione o plano...</option>
                </select>
            </div>
            <div class="input-field">
                <input id="resdatainicio" type="date" class="validate datapicker" name="resdatainicio" required>
                <label for="resdatainicio">Data de Início</label>
                @error('resdatainicio')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="resdatatermino" type="hidden" class="validate" name="resdatatermino">
                <input id="resdatatermino_aux" type="date" class="validate" name="resdatatermino_aux" required>
                <label for="resdatatermino">Data Término</label>
                @error('resdatatermino')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Parcelas</label>
                <br>
                <br>
                <select name="plaquantidadeparcela" class="validate browser-default" required>
                    <option value="" selected>Selecione a quantidade de parcelas...</option>
                </select>
            </div>
            <button id="btnEnviarFormIncluirReserva_{{$veiculo->veicodigo}}" data-veiculo-id="{{$veiculo->veicodigo}}" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Solicitar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var veiculo = @json($veiculo);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $('#btnEnviarFormIncluirReserva_'+veiculo.veicodigo).click(function(event){
                    var veicodigo = +$(this).data('veiculo-id'); 
                    event.preventDefault(); // Evite o envio do formulário padrão

                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();
                    
                    // Realize as validações aqui
                    var veicodigo = $('#modalIncluirReserva_'+veicodigo+' #veicodigo').val().trim();
                    var veidescricao = $('#modalIncluirReserva_'+veicodigo+' #veidescricao').val().trim();
                    var placodigo = $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').val().trim();
                    var resdatainicio = $('#modalIncluirReserva_'+veicodigo+' #resdatainicio').val().trim();
                    var resdatatermino = $('#modalIncluirReserva_'+veicodigo+' #resdatatermino').val().trim();
                    var plaquantidadeparcela = $('#modalIncluirReserva_'+veicodigo+' select[name="plaquantidadeparcela"]').val().trim();

                    var data = {
                        veicodigo: veicodigo,
                        veidescricao: veidescricao,
                        placodigo: placodigo,
                        resdatainicio: resdatainicio,
                        resdatatermino:resdatatermino,
                        plaquantidadeparcela:plaquantidadeparcela,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/cliente/reservas/validaInclusaoReserva',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#modalIncluirReserva_'+veicodigo+' #formIncluirReserva').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirReserva_'+veicodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            $('.error-message').remove();
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalIncluirReserva_'+veicodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });
    });
    </script>    