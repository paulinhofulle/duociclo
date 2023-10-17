@extends('site/lojista/menu')
@section('title', 'Duociclo - Meu Perfil')

@section('conteudo')
    <div class="row">
        <form id="formAlterarMeuPerfil" class="col s12" action="{{ route('alterarMeuPerfilLojista', ['id' => old('id', $usuario->id)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="id" name="id" value="{{ old('id', $usuario->id) }}">
            <h4 class="center">Meu Perfil</h4>
            <div class="input-field">
                <input id="usunome" type="text" class="validate" name="usunome" value="{{ old('usunome', $usuario->usunome) }}" disabled readonly>
                <label for="usunome">Nome</label>
                @error('usunome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="email" type="email" class="validate" name="email" value="{{ old('email', $usuario->email) }}" disabled readonly>
                <label for="email">E-mail</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usucpf" type="text" class="validate" name="usucpf" value="{{ old('usucpf', $usuario->usucpf) }}" disabled readonly>
                <label for="usucpf">CPF</label>
                @error('usucpf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="usudatanascimento" type="date" class="validate" name="usudatanascimento" value="{{ old('usudatanascimento', $usuario->usudatanascimento) }}" disabled readonly>
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
                <input id="usucep" type="number" class="validate" name="usucep" pattern="[0-9]{9}" maxlength="9" value="{{ old('usucep', $usuario->usucep) }}" placeholder="00000-000" required>
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
                <input id="password" type="password" class="validate" name="password">
                <label for="password">Senha Atual</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="newpassword" type="password" class="validate" name="newpassword">
                <label for="newpassword">Nova Senha</label>
                @error('newpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input id="newpassword_confirmation" type="password" class="validate" name="newpassword_confirmation">
                <label for="newpassword_confirmation">Confirmar Nova Senha</label>
                @error('newpassword_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
        </form>
    </div>
@endsection