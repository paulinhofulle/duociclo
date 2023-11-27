<div id="modalParcelaPaga_{{$parcela->parsequencia}}" class="modal">
    <div class="modal-content">
        <h4 class="center">Pagar</h4>
        <p style="font-size: larger"><i>Tem certeza que a parcela foi paga?</i></p>
        <form action="{{ route('pagarParcela', ['parcela' => $parcela->parsequencia, 'aluguel' => $parcela->alucodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $parcela->parsequencia }}">
            <button id="btnEnviarFormPagar" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Pagar</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>