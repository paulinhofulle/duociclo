@extends('site/layout')
@section('title', 'Duociclo')

@section('opcoesMenu')
    <li><a href="{{ url('/administrador') }}" style="text-decoration:none;">Home</a></li>
    <li><a href="{{ url('/administrador/lojas') }}" style="text-decoration:none;">Lojas</a></li>
    <li><a href="{{ url('/administrador/usuarios') }}" style="text-decoration:none;">Usuários</a></li>
@endsection

@section('opcoesUsuario')
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('logout')}}" style="color:orange;">Sair</a></li>
    </ul>
@endsection