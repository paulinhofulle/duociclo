<div id="modalRecusarReserva_{{$reserva->rescodigo}}" class="modal">
    <div class="modal-content">
        <h4 class="center">Recusar Reserva</h4>
        <p style="font-size: larger"><i>Tem certeza que deseja recusar a reserva?</i></p>
        <form action="{{ route('recusarReserva', ['id' => $reserva->rescodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $reserva->rescodigo }}">
            <button id="btnEnviarFormRecusar" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Recusar</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>