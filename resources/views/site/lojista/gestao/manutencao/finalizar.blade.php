<div id="modalFinalizarManutencao_{{$manutencao->mancodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formFinalizarManutencao" action="{{ route('finalizarManutencao', ['id' => old('mancodigo', $manutencao->mancodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="mancodigo" name="mancodigo" value="{{ old('mancodigo', $manutencao->mancodigo) }}">
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