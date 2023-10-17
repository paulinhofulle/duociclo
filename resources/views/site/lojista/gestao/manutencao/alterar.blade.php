<div id="modalAlterarManutencao_{{$manutencao->mancodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formAlterarManutencao" action="{{ route('alterarManutencao', ['id' => old('mancodigo', $manutencao->mancodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="mancodigo" name="mancodigo" value="{{ old('mancodigo', $manutencao->mancodigo) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="mandescricao" type="text" class="validate" name="mandescricao" value="{{ old('mandescricao', $manutencao->mandescricao) }}" required>
                <label for="mandescricao">Descrição</label>
                @error('mandescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="manvalor" type="text" class="validate" name="manvalor" placeholder="0,00" value="{{ old('manvalor', $manutencao->manvalor) }}" required>
                    <label for="manvalor">Valor</label>
                    @error('manvalor')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s6">
                    <input id="mandatainicio" type="date" class="validate" name="mandatainicio" value="{{ old('mandatainicio', $manutencao->mandatainicio) }}" required>
                    <label for="mandatainicio">Data de Início</label>
                    @error('mandatainicio')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-field">
                <input id="manobservacao" type="text" class="validate" name="manobservacao" value="{{ old('manobservacao', $manutencao->manobservacao) }}" placeholder="Ex: trocado oléo do motor...">
                <label for="manobservacao">Observação</label>
                @error('manobservacao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Veículo</label>
                <br>
                <br>
                <select name="veicodigo" class="validate browser-default" disabled required>
                    <option value="" selected>Selecione o veículo...</option>
                    @foreach ($veiculos as $veiculo)
                        <option value="{{ $veiculo->veicodigo }}" {{ $veiculo->veicodigo == $manutencao->veicodigo ? 'selected' : '' }}>{{ $veiculo->veidescricao }}</option>
                    @endforeach
                </select>
            </div> 
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>