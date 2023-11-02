@extends('site/lojista/menu')
@section('title', 'Duociclo - Aluguéis')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Aluguéis</h1>
              <span class="right chip">{{$totalAlugueis}} aluguéis cadastradas</span>  
            </div>
            @if (session('sucesso'))
                <div class="card green">
                    <div class="card-content white-text alert alert-success">
                        <span class="card-title">Parabéns</span>
                        {{ session('sucesso') }}
                    </div>
                </div>
            @endif

            @if (session('erro'))
                <div class="card green">
                    <div class="card-content white-text alert alert-erro">
                        <span class="card-title">Erro</span>
                        {{ session('erro') }}
                    </div>
                </div>
            @endif

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaManutencao') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar..." id="search" type="search" name="search" value="{{ $search }}">
                  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form>
            </div>
          </nav>     

            <div class="card z-depth-4 registros" >
            <table class="striped ">
                <thead>
                  <tr>
                    <th>ID</th>  
                    <th>Veículo</th>
                    <th>Cliente</th>
                    <th>Plano</th>
                    <th>Valor</th>
                    <th>Qtde Parcelas</th>
                    <th>Data Início</th>
                    <th>Data Término</th>
                    <th>Situação</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($alugueis as $aluguel)
                    @include('site/lojista/gestao/manutencao/visualizar', ['aluguel' => $aluguel])
                    @include('site/lojista/gestao/manutencao/parcela', ['aluguel' => $aluguel])
                    <tr>
                        <td>{{$aluguel->alucodigo}}</td>
                        <td>{{$aluguel->tbveiculo->veinome}}</td>
                        <td>{{$aluguel->user->usunome}}</td>
                        <td>{{$aluguel->tbplano->pladescricao}}</td>
                        <td>{{$aluguel->tbplano->plavalor}}</td>
                        <td>{{$aluguel->tbplano->plaquantidadeparcelas}}</td>
                        <td>{{ date('d/m/Y', strtotime($aluguel->aludatainicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($aluguel->aludatatermino)) }}</td>
                        <td>{{$aluguel->alusituacao}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-aluguel-id="{{ $aluguel->alucodigo }}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content seuBotaoDeParcelas" data-aluguel-id="{{ $aluguel->alucodigo }}" style="position: relative; bottom:0px;" title="Parcelas">
                                <i class="material-icons">receipt</i>
                            </button>
                        </td>
                    </tr>    
                  @endforeach
                  @include('site/lojista/gestao/aluguel/visualizar')
                      <tr>
                        <td>1</td>
                        <td>CG 125 ES</td>
                        <td>Paulinho Cliente</td>
                        <td>Mensal</td>
                        <td>R$500,00</td>
                        <td>1</td>
                        <td>02/11/2023</td>
                        <td>02/12/2023</td>
                        <td>Em Andamento</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                            <a href="{{route('consultaParcelaLojista')}}" class="btn-floating halfway-fab waves-effect waves-light secondary-content seuBotaoDeParcelas" style="background-color: gray !important; position: relative; bottom:0px;" title="Parcelas">
                                <i class="material-icons">receipt</i>
                            </a>
                            <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content seuBotaoDeAceitar" style="position: relative; bottom:0px;" title="Finalizar">
                              <i class="material-icons">check</i>
                          </button>
                        </td>
                    </tr>  
                </tbody>
              </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                $(document).ready(function() {
                    //VISUALIZAR
                    var modalVisualizarReserva = $('#modalVisualizarAluguel').modal();
                    modalVisualizarReserva[0].style.maxHeight = '100%';
                    $('.seuBotaoDeVisualizacao').click(function() {
                        preencherModalVisualizar(); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarReserva.modal('open');
                    });
                    function preencherModalVisualizar() {
                        $('#modalVisualizarAluguel .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Veículo:</b> CG 125 ES </p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Cliente:</b> Paulinho Cliente</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Plano:</b> Mensal</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Valor:</b>R$500,00</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Qtde Parcelas:</b> 1</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Data de Início:</b> 02/11/2023</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Data de Término:</b> 02/12/2023</p>');
                        //$('#modalVisualizarReserva .modal-content').append('<p><b>Data de Início:</b> ' + reserva.resdatainicio + '</p>');
                        //$('#modalVisualizarReserva .modal-content').append('<p><b>Data de Término:</b> ' + reserva.resdatatermino + '</p>');
                        //$('#modalVisualizarReserva .modal-content').append('<p><b>Situação:</b> ' + reserva.ressituacao + '</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Situação:</b> Pendente</p>');
                    };
                });
        
            </script>
            <div class="row center">
                {{$alugueis->links('custom/pagination')}}
            </div>              
    </div>

@endsection