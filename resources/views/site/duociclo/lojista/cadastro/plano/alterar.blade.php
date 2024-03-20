<div id="modalAlterarPlano_{{$plano->placodigo}}" class="modal" >
    <div class="modal-content">
        <!-- Formulário de edição da loja aqui -->
        <form id="formAlterarPlano" action="{{ route('alterarPlano', ['id' => old('placodigo', $plano->placodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="placodigo" name="placodigo" value="{{ old('placodigo', $plano->placodigo) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="pladescricao" type="text" class="validate" name="pladescricao" value="{{ old('pladescricao', $plano->pladescricao) }}" required>
                <label for="pladescricao">Descrição</label>
                @error('pladescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadedias" type="number" class="validate" name="plaquantidadedias" value="{{ old('plaquantidadedias', $plano->plaquantidadedias) }}" required disabled>
                <label for="plaquantidadedias">Quantidade de Dias</label>
                @error('plaquantidadedias')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plavalor" type="number" class="validate" name="plavalor" placeholder="0,00" value="{{ old('plavalor', $plano->plavalor) }}" required disabled>
                <label for="plavalor">Valor</label>
                @error('plavalor')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="plaquantidadeparcela" type="number" class="validate" name="plaquantidadeparcela" value="{{ old('plaquantidadeparcela', $plano->plaquantidadedias) }}" required disabled>
                <label for="plaquantidadeparcela">Quantidade de Parcelas</label>
                @error('plaquantidadeparcela')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>