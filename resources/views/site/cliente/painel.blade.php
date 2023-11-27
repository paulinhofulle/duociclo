@extends('site/cliente/menu')
@section('title', 'Duociclo')

@section('conteudo')
    @if ($aluguel == null)
        <div class="row container">
        <section class="info">
            <div class="col s12 m12">
                <article class="bg-gradient-orange card z-depth-4 ">
                    <i class="material-icons">motorcycle</i>
                    <p>Você não possui um aluguel ativo!</p>
                    <h3></h3>
                </article>
            </div>
        </section>
        </div>
    @else
        <div class="row container">
            <section class="info">
                <div class="col s12 m12">
                    <article class="bg-gradient-green card z-depth-4 ">
                        <i class="material-icons">motorcycle</i>
                        <p>Aluguel Ativo</p>
                        <ul>
                            <li style="color: white">Veículo: {{$aluguel->tbveiculo->veidescricao}}</li>
                            <li style="color: white">Plano: {{$aluguel->tbplano->pladescricao}}</li>
                            <li style="color: white">Data de Início: {{\Carbon\Carbon::createFromFormat('Y-m-d', $aluguel->aludatainicio)->format('d/m/Y')}}</li>
                            <li style="color: white">Data de Término: {{\Carbon\Carbon::createFromFormat('Y-m-d', $aluguel->aludatatermino)->format('d/m/Y')}}</li>
                            <li style="color: white">Valor: R${{$aluguel->tbplano->plavalor}}</li>
                        </ul>
                    </article>
                </div>
            </section>
        </div>
    @endif

    <div class="row container crud">

        <div class="row titulo ">              
            <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Parcelas</h1>
        </div>
        
        <div class="card z-depth-4 registros" >
            <table class="striped ">
                <thead>
                <tr>
                    <th>Parcela</th>  
                    <th>Valor</th>
                    <th>Data de Vencimento</th>
                    <th>Situação</th>
                </tr>
                </thead>
        
                <tbody>
                    @if ($aluguel !== null)
                        @foreach ($aluguel->tbparcela as $parcela)
                            <tr>
                                <td>{{$parcela->parsequencia}}</td>
                                <td>R${{$parcela->parvalor}}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $parcela->pardatavencimento)->format('d/m/Y') }}</td>
                                <td>{{$situacoes[$parcela->parsituacao]}}</td>
                            </tr>    
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endsection
