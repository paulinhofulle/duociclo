<div id="modalAlterarMarca_{{$marca->marcodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <!-- Formulário de edição da loja aqui -->
        <form id="formAlterarMarca" action="{{ route('alterarMarca', ['id' => old('marcodigo', $marca->marcodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="marcodigo" name="marcodigo" value="{{ old('marcodigo', $marca->marcodigo) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="marnome" type="text" class="validate" name="marnome" value="{{ old('marnome', $marca->marnome) }}" required>
                <label for="marnome">Nome</label>
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>