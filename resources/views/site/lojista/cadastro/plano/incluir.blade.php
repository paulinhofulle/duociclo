<div id="modalIncluirPlano" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirPlano" action="{{ route('incluirPlano') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="pladescricao" type="text" class="validate" name="pladescricao" required>
                <label for="pladescricao">Descrição</label>
                @error('pladescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadedias" type="number" class="validate" name="plaquantidadedias" required>
                <label for="plaquantidadedias">Quantidade de Dias</label>
                @error('plaquantidadedias')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plavalor" type="text" class="validate" name="plavalor" placeholder="0,00" required>
                <label for="plavalor">Valor</label>
                @error('plavalor')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadeparcela" type="number" class="validate" name="plaquantidadeparcela" required>
                <label for="plaquantidadeparcela">Quantidade de Parcelas</label>
                @error('plaquantidadeparcela')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>