@extends('site/layoutLogin')
@section('title', 'Duociclo')

@section('form')
<img src="/img/aralho.png" style="height: 30rem">
    {{-- @if($mensagem = Session::get('erro'))
        <div class="alert alert-erro">
            {{$mensagem}}
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-erro">
            {{$error}} <br>
        </div>
            
        @endforeach
    @endif

    @if(Session::has('sucesso'))
        <div class="alert alert-success">
            {{ Session::get('sucesso') }}
        </div>
    @endif

    <form action="{{route('login/auth')}}" method="POST">
        @csrf
        <img src="imagens/duociclo_logo.png" alt="Duociclo" style="margin-bottom:-3rem; margin-left:-2.75rem" height="200" width="200">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput1">
            <label for="floatingInput1">E-mail</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingInput2" placeholder="Senha" >
            <label for="floatingInput2">Senha</label>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2" style="background-color: #e2a951; border-color:white; color:white">Acessar</button>
    </form> --}}
@endsection

@section('botaoAux')
{{-- <a href="{{ url('/cadastrar') }}" class="btn btn-primary w-100 py-2" style="background-color: white; border-color:#e2a951; color:#e2a951">Cadastrar-se</a> --}}
@endsection