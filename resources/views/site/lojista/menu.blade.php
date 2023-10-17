@extends('site/layout')
@section('title', 'Duociclo')

@section('opcoesMenu')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <ul id="dropdownCadastro" class="dropdown-content">
        <li><a href="{{route('consultaMarca')}}" style="color:#ff9800;">Marcas</a></li>
        <li><a href="{{route('consultaVeiculo')}}" style="color:#ff9800;">Veículos</a></li>
        <li><a href="{{route('consultaPlano')}}" style="color:#ff9800;">Planos</a></li>
    </ul>

    <ul id="dropdownGestao" class="dropdown-content">
        <li><a href="{{route('consultaManutencao')}}" style="color:#ff9800;">Manutenções</a></li>
        <li><a href="{{route('consultaReserva')}}" style="color:#ff9800;">Reservas</a></li>
        <li><a href="{{route('consultaAluguel')}}" style="color:#ff9800;">Aluguéis</a></li>
    </ul>

    <li><a href="{{ url('/lojista') }}" style="text-decoration:none;">Home</a></li>
    <ul id="nav-mobile2" class="right">
        <li><a href="#" class="dropdown-trigger" data-target="dropdownGestao">Gestão<i class="material-icons right">expand_more</i></a></li>
    </ul>
    <ul id="nav-mobile2" class="right">
        <li><a href="#" class="dropdown-trigger" data-target="dropdownCadastro">Cadastros<i class="material-icons right">expand_more</i></a></li>
    </ul>
@endsection

@section('opcoesUsuario')
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('minhaLoja')}}" style="color:orange;">Minha Loja</a></li>
        <li><a href="{{route('meuPerfilLojista')}}" style="color:orange;">Meu Perfil</a></li>
        <li><a href="{{route('logout')}}" style="color:orange;">Sair</a></li>
    </ul>
@endsection
