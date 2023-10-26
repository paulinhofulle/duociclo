@extends('site/layout')
@section('title', 'Duociclo')

@section('opcoesMenu')
    <li><a href="{{ url('/cliente') }}" style="text-decoration:none;">Home</a></li>
    <li><a href="{{ url('/cliente/reservas') }}" style="text-decoration:none;">Solicitar Reserva</a></li>
    <li><a href="{{ url('/cliente/alugueis') }}" style="text-decoration:none;">Meus Aluguéis</a></li>
@endsection

@section('opcoesUsuario')
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('meuPerfilCliente')}}" style="color:orange;">Meu Perfil</a></li>
        <li><a href="{{route('logout')}}" style="color:orange;">Sair</a></li>
    </ul>
@endsection