<div id="modalAlterarUsuario_{{$usuario->id}}" class="modal" style="max-height: 100%">
    <div class="modal-content">
        <!-- Formulário de edição de usuario aqui -->
        <form id="formAlterarUsuario" action="{{ route('alterarUsuario', ['id' => old('id', $usuario->id)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="id" name="id" value="{{ old('id', $usuario->id) }}">
            <h4 class="center">Alterar</h4>
            <div class="input-field">
                <input id="usunome" type="text" class="validate" name="usunome" value="{{ old('usunome', $usuario->usunome) }}" required>
                <label for="usunome">Nome</label>
                @error('usunome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucpf" type="text" class="validate" name="usucpf" value="{{ old('usucpf', $usuario->usucpf) }}" required>
                <label for="usucpf">CPF</label>
                @error('usucpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usudatanascimento" type="date" class="validate" name="usudatanascimento" value="{{ old('usudatanascimento', $usuario->usudatanascimento) }}" required>
                <label for="usudatanascimento">Data de Nascimento</label>
                @error('usudatanascimento')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usutelefone" type="tel" class="validate" name="usutelefone" value="{{ old('usutelefone', $usuario->usutelefone) }}" placeholder="XX XXXXX-XXXX" required>
                <label for="usutelefone">Telefone</label>
                @error('usutelefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucep" type="number" class="validate" name="usucep" value="{{ old('usucep', $usuario->usucep) }}" placeholder="00000-000" required>
                <label for="usucep">CEP</label>
                @error('usucep')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usunumeroendereco" type="number" class="validate" name="usunumeroendereco" value="{{ old('usunumeroendereco', $usuario->usunumeroendereco) }}" required>
                <label for="usunumeroendereco">N° Endereço</label>
                @error('usunumeroendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucomplementoendereco" type="text" class="validate" name="usucomplementoendereco" value="{{ old('usucomplementoendereco', $usuario->usucomplementoendereco) }}">
                <label for="usucomplementoendereco">Complemento Endereço</label>
                @error('usucomplementoendereco')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="email" type="email" class="validate" name="email" value="{{ old('email', $usuario->email) }}" required>
                <label for="email">E-mail</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label>Loja</label>
                <br>
                <br>
                <select name="lojcodigo" id="lojcodigo" value="{{ old('lojcodigo', $usuario->lojcodigo) }}" class="validate browser-default" required>
                    <option value="" selected>Selecione a loja...</option>
                    @foreach ($lojas as $loja)
                    <option value="{{ $loja->lojcodigo }}" {{ $loja->lojcodigo == $usuario->lojcodigo ? 'selected' : '' }}>{{ $loja->lojnome }}</option>
                    @endforeach
                </select>
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange" onclick="enviarFormulario()">Salvar</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </form>
    </div>
</div>