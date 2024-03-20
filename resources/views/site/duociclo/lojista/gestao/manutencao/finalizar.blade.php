<div id="modalFinalizarManutencao_{{$manutencao->mancodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formFinalizarManutencao" action="{{ route('finalizarManutencao', ['id' => old('mancodigo', $manutencao->mancodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="mancodigo" name="mancodigo" value="{{ old('mancodigo', $manutencao->mancodigo) }}">
            <input type="hidden" id="mandatainicio" name="mandatainicio" value="{{ old('mandatainicio', $manutencao->mandatainicio) }}">
            <h4 class="center">Finalizar</h4>
            <div class="input-field">
                <input id="mandatatermino" type="date" class="validate" name="mandatatermino" required>
                <label for="mandatatermino">Data de Término</label>
                @error('mandatatermino')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormFinalizar" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Finalizar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
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

            $('#btnEnviarFormFinalizar').click(function(event){
                    event.preventDefault(); // Evite o envio do formulário padrão
                    var mancodigo = +$('#mancodigo').val(); 
                    // Limpar mensagens de erro existentes
                    $('.error-message').remove();

                    // Realize as validações aqui
                    var mandatatermino = $('#modalFinalizarManutencao_'+mancodigo+' #mandatatermino').val().trim();
                    var mandatainicio = $('#modalFinalizarManutencao_'+mancodigo+' #mandatainicio').val().trim();
                    
                    var data = {
                        mandatainicio: mandatainicio,
                        mandatatermino: mandatatermino,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/lojista/manutencoes/validaFinalizacaoManutencao',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#formFinalizarManutencao').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalFinalizarManutencao_'+mancodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    $('#modalFinalizarManutencao_'+mancodigo+' #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });
    });
    </script> 