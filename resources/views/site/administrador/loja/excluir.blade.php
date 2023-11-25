<div id="modalExcluirLoja_{{$loja->lojcodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <h4 class="center">Excluir</h4>
        <p style="font-size: larger"><i>Tem certeza que deseja excluir o registro?</i></p>
        <form action="{{ route('excluirLoja', ['id' => $loja->lojcodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $loja->lojcodigo }}">
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Excluir</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>