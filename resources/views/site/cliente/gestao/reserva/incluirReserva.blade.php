<div id="modalIncluirReserva" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirVeiculo" action="{{ route('incluirVeiculo') }}" method="POST">
            @csrf
            <h4 class="center">Solicitar</h4>
            <div class="input-field">
                <input id="veidescricao" type="text" class="validate" name="veidescricao" value="CG 125 ES" disabled>
                <label for="veidescricao">Veículo</label>
                @error('veidescricao')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Plano</label>
                <br>
                <br>
                <select name="marcodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione o plano...</option>
                </select>
            </div> 
            <div class="input-field">
                <input id="veicor" type="date" class="validate" name="veicor" >
                <label for="veicor">Data de Início</label>
                @error('veinome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="veiano" type="date" class="validate" name="veiano"  placeholder="XXXX" required>
                <label for="veiano">Data Término</label>
                @error('veiano')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Parcelas</label>
                <br>
                <br>
                <select name="marcodigo" class="validate browser-default" required>
                    <option value="" selected>Selecione a quantidade de parcelas...</option>
                </select>
            </div>
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Solicitar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>