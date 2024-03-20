<div id="modalAceitarReserva_{{$reserva->rescodigo}}" class="modal">
    <div class="modal-content">
        <h4 class="center">Aceitar Reserva</h4>
        <p style="font-size: larger"><i>Tem certeza que deseja aceitar a reserva?</i></p>
        <form action="{{ route('aceitarReserva', ['id' => $reserva->rescodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $reserva->rescodigo }}">
            <button id="btnEnviarFormAceitar" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Aceitar</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>