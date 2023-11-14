@extends('site/cliente/menu')
@section('title', 'Duociclo')

@section('conteudo')
    @if ($aluguel == null)
        <div class="row container">
            <section class="info">
                <div class="col s12 m12">
                    <article class="bg-gradient-green card z-depth-4 ">
                        <i class="material-icons">motorcycle</i>
                        <p>Aluguel Ativo</p>
                        <ul style="color: white">
                            <li>Veículo: CG 125 ES</li>
                            <li>Plano: Mensal</li>
                            <li>Data de Início: 02/11/2023</li>
                            <li>Data de Término: 02/12/2023</li>
                            <li>Valor:R$500,00</li>
                        </ul>
                    </article>
                </div>
            </section>
        </div>
    @else
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



        <div class="row container">
            <section class="info">
                <div class="col s12 m12">
                    <article class="bg-gradient-green card z-depth-4 ">
                        <i class="material-icons">motorcycle</i>
                        <p>Aluguel Ativo</p>
                        <ul>
                            <li>Veículo:{{$aluguel->veidescricao}}</li>
                            <li>Plano:{{$aluguel->pladescricao}}</li>
                            <li>Data de Início:{{$aluguel->aludatainicio}}</li>
                            <li>Data de Término:{{$aluguel->aludatatermino}}</li>
                            <li>Valor:R${{$aluguel->plavalor}}</li>
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
                                <td>{{$parcela->parvalor}}</td>
                                <td>{{$parcela->pardatavalidade}}</td>
                                <td>{{$parcela->parsituacao}}</td>
                                </td>
                            </tr>    
                        @endforeach
                    @endif

                    <tr>
                        <td>1</td>
                        <td>R$500,00</td>
                        <td>10/11/2023</td>
                        <td>Aberta</td>
                        </td>
                    </tr>    
                </tbody>
            </table>
        </div>
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@endsection
