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