<div id="modalAlterarVeiculo_{{$veiculo->veicodigo}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <!-- Formulário de edição da loja aqui -->
        <form id="formAlterarVeiculo" action="{{ route('alterarVeiculo', ['id' => old('veicodigo', $veiculo->veicodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="veicodigo" name="veicodigo" value="{{ old('veicodigo', $veiculo->veicodigo) }}">
            <h4 class="center">Alterar</h4>
            <div class="file-field input-field">
                <div class="btn" style="background-color: #ff9800;">
                    <span>Imagem</span>
                    <input name="veiimagem" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field">
                <input id="veidescricao" type="text" class="validate" name="veidescricao" value="{{ old('veidescricao', $veiculo->veidescricao) }}">
                <label for="veidescricao">Descrição</label>
                @error('veidescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veicor" type="text" class="validate" name="veicor" value="{{ old('veicor', $veiculo->veicor) }}">
                <label for="veicor">Cor</label>
                @error('veinome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiano" type="number" class="validate" name="veiano" value="{{ old('veiano', $veiculo->veiano) }}" placeholder="XXXX" required>
                <label for="veiano">Ano</label>
                @error('veiano')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiquilometragem" type="number" class="validate" name="veiquilometragem" value="{{ old('veiquilometragem', $veiculo->veiquilometragem) }}" required>
                <label for="veiquilometragem">KM</label>
                @error('veiquilometragem')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiplaca" type="text" class="validate" name="veiplaca" value="{{ old('veiplaca', $veiculo->veiplaca) }}" required>
                <label for="veiplaca">Placa</label>
                @error('veiplaca')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Marca</label>
                <br>
                <br>
                <select name="marcodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione a marca...</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->marcodigo }}" {{ $marca->marcodigo == $veiculo->marcodigo ? 'selected' : '' }}>{{ $marca->marnome }}</option>
                    @endforeach
                </select>
            </div> 
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>