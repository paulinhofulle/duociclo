@extends('site/cliente/menu')
@section('title', 'Duociclo - Reservas')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Reservas</h1>
              <span class="right chip">{{$totalReservas}} reservas solicitadas</span>  
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

            <div class="row">
                <a id="openModalBtnIncluir" href="{{route('reservaCliente')}}" class="btn" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Solicitar
                </a>
            </div>


           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaManutencao') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar pelo Veículo..." id="search" type="search" name="search" value="{{ $search }}">
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
                    <th></th>
                    <th>ID</th>  
                    <th>Veículo</th>
                    <th>Loja</th>
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
                  @foreach ($reservas as $reserva)
                    @include('site/lojista/gestao/reserva/visualizar', ['reserva' => $reserva])
                    <tr>
                        <td>{{$reserva->rescodigo}}</td>
                        <td>{{$reserva->tbveiculo->veidescricao}}</td>
                        <td>{{$reserva->users->usunome}}</td>
                        <td>{{$reserva->tbplano->pladescricao}}</td>
                        <td>{{ date('d/m/Y', strtotime($reserva->resdatainicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($reserva->resdatatermino)) }}</td>
                        <td>{{$reserva->ressituacao}}</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-reserva-id="{{ $reserva->rescodigo }}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                        </td>
                    </tr>    
                  @endforeach
                  @include('site/cliente/gestao/reserva/visualizar')
                  <tr>
                    <td><img src="{{ asset('imagens/download.png') }}"></td>
                    <td>1</td>
                    <td>CG 125 ES</td>
                    <td>Motos Neno</td>
                    <td>Mensal</td>
                    <td>R$500,00</td>
                    <td>1</td>
                    <td>02/11/2023</td>
                    <td>02/12/2023</td>
                    <td>Aceita</td>
                    <td style="display: flex; justify-content:end;">
                        <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;">
                            <i class="material-icons">remove_red_eye</i>
                        </button>
                    </td>
                </tr>  
                </tbody>
              </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                var reservas = @json($reservas).data;

                $(document).ready(function() {
                    //VISUALIZAR
                    var modalVisualizarReserva = $('#modalVisualizarReserva').modal();
                    modalVisualizarReserva[0].style.maxHeight = '100%';
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var rescodigo = $(this).data('reserva-id'); // Obtém o ID da loja do atributo data-loja-id
                        var reserva = encontrarReservaPorId(rescodigo); // Encontra a loja correspondente no array de lojas
                        preencherModalVisualizar(reserva); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarReserva.modal('open');
                    });

                    function encontrarReservaPorId(id) {
                        return reservas.find(function(reserva) {
                            return reserva.rescodigo === id;
                        });
                    };

                    function preencherModalVisualizar(reserva) {
                        $('#modalVisualizarReserva .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Veículo:</b> CG 125 ES</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Loja:</b> Motos Neno</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Plano:</b> Mensal</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Valor:</b>R$500,00</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Qtde Parcelas:</b> 1</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Data de Início:</b> 02/11/2023</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Data de Término:</b>02/12/2023</p>');
                        $('#modalVisualizarReserva .modal-content').append('<p><b>Situação:</b>Aceita</p>');
                    };


                });
        
            </script>
            <div class="row center">
                {{$reservas->links('custom/pagination')}}
            </div>              
    </div>  

@endsection