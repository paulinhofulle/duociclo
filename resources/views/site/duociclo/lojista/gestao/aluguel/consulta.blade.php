@extends('site/lojista/menu')
@section('title', 'Duociclo - Aluguéis')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Aluguéis</h1>
              <span class="right chip">1 aluguéis cadastrados</span>  
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
              <form action="{{ route('consultaAluguelLojista') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar pelo Veículo..." id="search" type="search" name="search" value="{{ $search }}">
                  <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>
              </form>
            </div>
          </nav>     

            <div class="card z-depth-4 registros" >
            <table class="striped responsive-table">
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
                    @include('site/lojista/gestao/aluguel/visualizar', ['aluguel' => $aluguel])
                    @include('site/lojista/gestao/aluguel/finalizar', ['aluguel' => $aluguel])
                    <tr>
                        <td>{{$aluguel->alucodigo}}</td>
                        <td>{{$aluguel->tbveiculo->veidescricao}}</td>
                        <td>{{$aluguel->user->usunome}}</td>
                        <td>{{$aluguel->tbplano->pladescricao}}</td>
                        <td>R${{$aluguel->tbplano->plavalor}}</td>
                        <td>{{$aluguel->aluquantidadeparcela}}</td>
                        <td>{{ date('d/m/Y', strtotime($aluguel->aludatainicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($aluguel->aludatatermino)) }}</td>
                        <td>{{$situacoes[$aluguel->alusituacao]}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-aluguel-id="{{ $aluguel->alucodigo }}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                            <a href="{{route('consultaParcelasAluguel', ['aluguel' => $aluguel->alucodigo])}}" class="btn-floating halfway-fab waves-effect waves-light green secondary-content" data-aluguel-id="{{ $aluguel->alucodigo }}" style="background-color: gray !important; position: relative; bottom:0px;" title="Parcelas">
                                <i class="material-icons">receipt</i>
                            </a>
                            @if ($aluguel->todasParcelasPagas() && $aluguel->alusituacao == 1)
                                  <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content seuBotaoDeFinalizar" data-aluguel-id="{{ $aluguel->alucodigo }}" style="position: relative; bottom:0px;" title="Finalizar">
                                      <i class="material-icons">check</i>
                                  </button>
                              @endif
                        </td>
                    </tr>    
                  @endforeach 
                </tbody>
              </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                $(document).ready(function() {
                  var alugueis    = @json($alugueis).data;

                    function encontrarAluguelPorId(id) {
                        return alugueis.find(function(aluguel) {
                            return aluguel.alucodigo === id;
                        });
                    };
                    //VISUALIZAR
                    var modalVisualizarReserva = $('#modalVisualizarAluguel').modal();
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var alucodigo = $(this).data('aluguel-id'); // Obtém o ID da loja do atributo data-loja-id
                        var aluguel = encontrarAluguelPorId(alucodigo);
                        preencherModalVisualizar(aluguel); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarReserva.modal('open');
                    });
                    function preencherModalVisualizar(aluguel) {
                        var modalContent = $('#modalVisualizarAluguel .modal-content');
    
                        // Limpar conteúdo anterior
                        modalContent.empty();
                        $('#modalVisualizarAluguel .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Veículo:</b> '+aluguel.tbveiculo.veidescricao+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Cliente:</b> '+aluguel.user.usunome+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Plano:</b> '+aluguel.tbplano.pladescricao+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Valor:</b> R$'+aluguel.tbplano.plavalor+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Qtde Parcelas:</b> '+aluguel.aluquantidadeparcela+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Data de Início:</b> '+aluguel.aludatainicio+'</p>');
                        $('#modalVisualizarAluguel .modal-content').append('<p><b>Data de Término:</b> '+aluguel.aludatatermino+'</p>');
                    };

                    $('.seuBotaoDeFinalizar').click(function() {
                      debugger;
                        var alucodigo = $(this).data('aluguel-id'); 
                        var modalFinalizarAluguel = $('#modalFinalizarAluguel_' + alucodigo).modal();
                        modalFinalizarAluguel.modal('open');
                    });
                });
        
            </script>
            <div class="row center">
                {{$alugueis->links('custom/pagination')}}
            </div>              
    </div>

@endsection