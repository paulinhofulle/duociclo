<div id="modalIncluirMarca" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirMarca" action="{{ route('incluirMarca') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="marnome" type="text" class="validate" name="marnome" required>
                <label for="marnome">Nome</label>
            </div>
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>