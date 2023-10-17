<div id="modalIncluirLoja" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <form id="formIncluirLoja" action="{{ route('incluirLoja') }}" method="POST">
            @csrf
            <h4 class="center">Incluir</h4>
            <div class="input-field">
                <input id="lojnome" type="text" class="validate" name="lojnome" required>
                <label for="lojnome">Nome da Loja</label>
                @error('lojnome')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcnpj" type="number" class="validate" name="lojcnpj" required>
                <label for="lojcnpj">CNPJ</label>
                @error('lojcnpj')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojtelefone" type="tel" class="validate" name="lojtelefone" placeholder="XX XXXXX-XXXX" required>
                <label for="lojtelefone">Telefone</label>
                @error('lojtelefone')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojemail" type="email" class="validate" name="lojemail" required>
                <label for="lojemail">E-mail</label>
                @error('lojemail')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcep" type="number" class="validate" name="lojcep" placeholder="00000-000" required>
                <label for="lojcep">CEP</label>
                @error('lojcep')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojnumeroendereco" type="number" class="validate" name="lojnumeroendereco" required>
                <label for="lojnumeroendereco">N° Endereço</label>
                @error('lojnumeroendereco')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="lojcomplementoendereco" type="text" class="validate" name="lojcomplementoendereco">
                <label for="lojcomplementoendereco">Complemento Endereço</label>
                @error('lojcomplementoendereco')
                    <span class="error-message" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormIncluir" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            <a href="#!" id="btnFecharIncluir" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>