<div id="modalFinalizarAluguel_{{$aluguel->alucodigo}}" class="modal">
    <div class="modal-content">
        <h4 class="center">Finalizar</h4>
        <p style="font-size: larger"><i>Tem certeza que deseja finalizar o aluguel?</i></p>
        <p style="font-size: larger"><i><b>Ao confirmar não será possível abrir novamente.</b></i></p>
        <form action="{{ route('finalizarAluguel', ['aluguel' => $aluguel->alucodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="alucodigo" value="{{ $aluguel->alucodigo }}">
            <div class="input-field">
                <input id="veiquilometragem" type="number" class="validate" name="veiquilometragem" required>
                <label for="veiquilometragem">KM FINAL</label>
                @error('veiquilometragem')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormPagar" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Finalizar</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>