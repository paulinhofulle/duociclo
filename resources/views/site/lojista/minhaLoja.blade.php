@extends('site/lojista/menu')
@section('title', 'Duociclo - Minha Loja')

@section('conteudo')
    <div class="row" style="margin-left: 15rem; margin-right:15rem;">
        <form id="formAlterarMinhaLoja" class="col s12" action="{{ route('alterarMinhaLoja', ['id' => old('lojcodigo', $loja->lojcodigo)]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="lojcodigo" name="lojcodigo" value="{{ old('lojcodigo', $loja->lojcodigo) }}">
            <h4 class="center">Minha Loja</h4>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnome" type="text" class="validate" name="lojnome" value="{{ old('lojnome', $loja->lojnome) }}" disabled readonly>
                    <label for="lojnome">Nome da Loja</label>
                    @error('lojnome')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojcnpj" type="number" class="validate" name="lojcnpj" value="{{ old('lojcnpj', $loja->lojcnpj) }}" disabled readonly>
                    <label for="lojcnpj">CNPJ</label>
                    @error('lojcnpj')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojtelefone" type="tel" class="validate" name="lojtelefone" value="{{ old('lojtelefone', $loja->lojtelefone) }}" placeholder="XX XXXXX-XXXX" required>
                    <label for="lojtelefone">Telefone</label>
                    @error('lojtelefone')
                        <span class="text-danger" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojemail" type="email" class="validate" name="lojemail" value="{{ old('lojemail', $loja->lojemail) }}" required>
                    <label for="lojemail">E-mail</label>
                    @error('lojemail')
                        <span class="text-danger"  style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="input-field">
                <input id="lojcep" type="number" class="validate" name="lojcep" placeholder="00000-000" value="{{ old('lojcep', $loja->lojcep) }}" required>
                <label for="lojcep">CEP</label>
                @error('lojcep')
                    <span class="text-danger" style="color:red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnumeroendereco" type="text" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                    <label for="lojnumeroendereco">Rua</label>
                    @error('lojnumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojnumeroendereco" type="text" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                    <label for="lojnumeroendereco">Bairro</label>
                    @error('lojnumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnumeroendereco" type="text" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                    <label for="lojnumeroendereco">Cidade</label>
                    @error('lojnumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-fieldcol col s12 m6">
                        <label>Estado</label>
                        <select name="marcodigo" class="validate browser-default" required>
                            <option value="" selected>Santa Catarina</option>
                        </select>
                    @error('lojestado')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="lojnumeroendereco" type="number" class="validate" name="lojnumeroendereco" value="{{ old('lojnumeroendereco', $loja->lojnumeroendereco) }}" required>
                    <label for="lojnumeroendereco">N° Endereço</label>
                    @error('lojnumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6">
                    <input id="lojcomplementoendereco" type="text" class="validate" name="lojcomplementoendereco" value="{{ old('lojcomplementoendereco', $loja->lojcomplementoendereco) }}">
                    <label for="lojcomplementoendereco">Complemento Endereço</label>
                    @error('lojcomplementoendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
            <div class="row center">
                <button id="btnEnviarFormAlteracao" type="submit" class="btn waves-effect waves-light" style="background-color: orange">Salvar</button>
            </div>
        </form>
    </div>
@endsection