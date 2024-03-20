<div id="modalExcluirManutencao_{{$manutencao->mancodigo}}" class="modal">
    <div class="modal-content">
        <h4 class="center">Excluir</h4>
        <p style="font-size: larger"><i>Tem certeza que deseja excluir o registro?</i></p>
        <form action="{{ route('excluirManutencao', ['id' => $manutencao->mancodigo]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $manutencao->mancodigo }}">
            <button id="btnEnviarFormExclusao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Excluir</button><a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>