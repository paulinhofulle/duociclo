<div id="modalIncluirManutencao" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirManutencao" action="{{ route('incluirManutencao') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="mandescricao" type="text" class="validate" name="mandescricao" required>
                <label for="mandescricao">Descrição</label>
                @error('mandescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="manvalor" type="text" class="validate" name="manvalor" placeholder="0,00" required>
                    <label for="manvalor">Valor</label>
                    @error('manvalor')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6">
                    <input id="mandatainicio" type="date" class="validate" name="mandatainicio" required>
                    <label for="mandatainicio">Data de Início</label>
                    @error('mandatainicio')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-field">
                <input id="manobservacao" type="text" class="validate" name="manobservacao" placeholder="Ex: trocado oléo do motor...">
                <label for="manobservacao">Observação</label>
                @error('manobservacao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Veículo</label>
                <br>
                <br>
                <select name="veicodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione o veículo...</option>
                    @foreach ($veiculosDisponiveis as $veiculo)
                        <option value="{{ $veiculo->veicodigo }}">{{ $veiculo->veidescricao }}</option>
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
                    var mandescricao = $('#modalIncluirManutencao #mandescricao').val().trim();
                    var mandatainicio = $('#modalIncluirManutencao #mandatainicio').val().trim();
                    var manvalor = $('#modalIncluirManutencao #manvalor').val().trim();
                    var veicodigo = $('#modalIncluirManutencao select[name="veicodigo"]').val().trim();
                    
                    var data = {
                        mandescricao: mandescricao,
                        mandatainicio: mandatainicio,
                        manvalor: manvalor,
                        veicodigo: veicodigo,
                    };

                    // Enviar solicitação AJAX para validar no servidor
                    $.ajax({
                        url: '/lojista/manutencoes/validaInclusaoManutencao',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.isValid) {
                                $('#formIncluirManutencao').submit();
                            } else {
                                // Se houver erros, exiba as mensagens
                                M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(response.errors, function (key, value) {
                                    $('#modalIncluirManutencao #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                });
                            }
                        },
                        error: function (error) {
                            M.toast({ html: 'Por favor, corrija os erros no formulário antes de prosseguir.', classes: 'red' });
                                
                                // Adicione mensagens de erro aos campos
                                $.each(error.responseJSON.errors, function (key, value) {
                                    if(key == 'veicodigo'){
                                        $('#modalIncluirManutencao select[name="veicodigo"]').after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    }
                                    else{
                                        $('#modalIncluirManutencao #' + key).after('<span class="error-message" style="color:red;">' + value[0] + '</span>');
                                    }
                                    $('label[for="'+key+'"]').addClass('active');
                                });
                            // Lidar com erros aqui
                        }
                    });
                });
    });
    </script> 