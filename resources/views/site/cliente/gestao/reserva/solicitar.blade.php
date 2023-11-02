@extends('site/cliente/menu')
@section('title', 'Duociclo - Solicitar Reserva')

@section('conteudo')
    <div class="row container crud">

        <div class="row titulo ">              
            <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Veículos</h1>
            <a href="{{route('consultaReservaCliente')}}" class="modal-close waves-effect waves-green btn-flat" style="background-color: orange !important; color:white !important; margin-left:1rem;">Voltar</a>
        </div>
        
      
        <div class="row">
            @include('site/cliente/gestao/reserva/incluirReserva')
            @include('site/cliente/gestao/reserva/visualizarLoja')
            @include('site/cliente/gestao/reserva/visualizarVeiculo')
            <div class="col s6 m3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('imagens/download.png') }}">
                        <a id="openModalBtnIncluir" href="#modalIncluirVeiculo" class="btn-floating waves-effect waves-light green right modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                            <i class="material-icons left">add</i>Incluir
                        </a>
                        <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoVeiculo"><i class="material-icons">motorcycle</i></a>
                        <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoLoja"><i class="material-icons">store</i></a>
                        
                    </div>
                    <div class="card-content">
                        <p><b>Descrição:</b> CG 125 ES</p>
                        <p><b>Ano:</b> 2005</p>
                        <p><b>Cor:</b> Vermelha</p>
                        <p><b>KM:</b> 125.000</p>
                        <p><b>Loja:</b> Motos Neno</p>
                    </div>
                </div>
            </div>


            <div class="col s6 m3">
                <div class="card">
                  <div class="card-image">
                    <img src="{{ asset('imagens/download.png') }}">
                    <a id="openModalBtnIncluir" href="#modalIncluirReserva" class="btn-floating waves-effect waves-light green right modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                        <i class="material-icons left">add</i>Incluir
                    </a>
                    <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoVeiculo"><i class="material-icons">motorcycle</i></a>
                        <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoLoja"><i class="material-icons">store</i></a>
                        </div>
                  <div class="card-content">
                    <p><b>Descrição:</b> CG 125 ES</p>
                    <p><b>Ano:</b> 2009</p>
                    <p><b>Cor:</b> Vermelha</p>
                    <p><b>KM:</b> 78.537</p>
                    <p><b>Loja:</b> Honda</p>
                  </div>
                </div>
              </div>
          </div>
  
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                $(document).ready(function() {
                    var modalIncluirVeiculo = $('#modalIncluirReserva').modal();
                    modalIncluirVeiculo[0].style.maxHeight = '80%';
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirVeiculo.modal("open");
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                    });
        
                    modalIncluirVeiculo.modal({
                        dismissible: false
                    });
                    
                    function limparCamposModalIncluir() {
                        $('#marnome').val('');
                    };
        
                    function limparClassesCampos() {
                        $('#marnome')[0].className = 'validate';
                    };
                    
                    $("#btnFecharIncluir").click(function() {
                        limparCamposModalIncluir();
                    });


                    //VISUALIZAR
                    var modalVisualizarReserva = $('#modalReservaVisualizarLoja').modal();
                    modalVisualizarReserva[0].style.maxHeight = '100%';
                    $('.seuBotaoDeVisualizacaoLoja').click(function() {
                        preencherModalVisualizarLoja(); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarReserva.modal('open');
                    });

                    function preencherModalVisualizarLoja() {
                        $('#modalReservaVisualizarLoja .modal-content').html('');
                        $('#modalReservaVisualizarLoja .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Nome da Loja:</b> Motos Neno</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>CNPJ:</b> 12345678901234</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Telefone:</b> 47988061721</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>E-mail:</b> motosneno@gmail.com</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>CEP:</b> 89163467</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>N° Endereço:</b> 62</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Complemento Endereço:</b> Loja de motocicletas</p>');
                    };
                    var modalVisualizarReservaa = $('#modalReservaVisualizarVeiculo').modal();
                    modalVisualizarReservaa[0].style.maxHeight = '100%';
                    $('.seuBotaoDeVisualizacaoVeiculo').click(function() {
                        preencherModalVisualizarVeiculo(); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarReservaa.modal('open');
                    });

                    function preencherModalVisualizarVeiculo() {
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Descrição:</b> CG 125 ES</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Cor:</b> Vermelha</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Ano:</b> 2005 </p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>KM:</b> 125000</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Placa:</b> ABC123 </p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Marca:</b> Honda</p>');
                    };

                    
                });
        
            </script>
@endsection