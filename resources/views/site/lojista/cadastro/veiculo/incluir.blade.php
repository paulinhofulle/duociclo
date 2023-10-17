<div id="modalIncluirVeiculo" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirVeiculo" action="{{ route('incluirVeiculo') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="file-field input-field">
                <div class="btn" style="background-color: #ff9800;">
                    <span>Imagem</span>
                    <input id="veiimagem" name="veiimagem" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field">
                <input id="veidescricao" type="text" class="validate" name="veidescricao">
                <label for="veidescricao">Descrição</label>
                @error('veidescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veicor" type="text" class="validate" name="veicor">
                <label for="veicor">Cor</label>
                @error('veinome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiano" type="number" class="validate" name="veiano" placeholder="XXXX" required>
                <label for="veiano">Ano</label>
                @error('veiano')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veikm" type="number" class="validate" name="veikm" required>
                <label for="veikm">KM</label>
                @error('veikm')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiplaca" type="text" class="validate" name="veiplaca" required>
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
                        <option value="{{ $marca->marcodigo }}">{{ $marca->marnome }}</option>
                    @endforeach
                </select>
            </div> 
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>