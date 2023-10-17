@extends('site/layoutLogin')
@section('title', 'Duociclo - Cadastrar-se')

@section('form')
    <form action="{{route('registrar')}}" method="POST">
        @csrf
        <img src="imagens/duociclo_logo.png" alt="Duociclo" style="margin-bottom:-3rem; margin-left:-2.75rem" height="200" width="200">
        <h1 class="h3 mb-3 fw-normal">Cadastrar-se</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usunome" name="usunome" required>
                    <label for="usunome">Nome</label>
                    @error('usunome')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="usucpf" name="usucpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
                    <label for="usucpf">CPF</label>
                    @error('usucpf')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="usudatanascimento" name="usudatanascimento" required>
                    <label for="usudatanascimento">Data de Nascimento</label>
                    @error('usudatanascimento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="usutelefone" name="usutelefone" placeholder="(XX) XXXXX-XXXX" required>
                    <label for="usutelefone">Telefone</label>
                    @error('usutelefone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="email">E-mail</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usucep" name="usucep" placeholder="00000-000" required>
                    <label for="usucep">CEP</label>
                    @error('usucep')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="usunumeroendereco" name="usunumeroendereco" required>
                    <label for="usunumeroendereco">N° Endereço</label>
                    @error('usunumeroendereco')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usucomplemento" name="usucomplemento">
                    <label for="usucomplemento">Complemento</label>
                    @error('usucomplemento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                    <label for="password">Senha</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Senha" required>
                    <label for="password_confirmation">Confirmar Senha</label>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary w-100 py-2" style="background-color: #e2a951; border-color:white; color:white">Cadastrar</button>
    </form>
@endsection

@section('botaoAux')
<a href="{{ url('/') }}" class="btn btn-primary w-100 py-2" style="background-color: white; border-color:#e2a951; color:#e2a951">Voltar</a>
@endsection