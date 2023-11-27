@extends('site/lojista/menu')
@section('title', 'Duociclo - Parcelas')

@section('conteudo')
    <div class="row container crud">
        <div class="row titulo ">              
            <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Parcelas</h1>  
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
                
            <div class="card z-depth-4 registros" >
            <table class="striped ">
                <thead>
                  <tr>
                    <th>Sequência</th>  
                    <th>Valor</th>
                    <th>Data de Vencimento</th>
                    <th>Situação</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                    @foreach ($parcelas as $parcela)
                        @include('site/lojista/gestao/aluguel/aberta', ['parcela' => $parcela])
                        @include('site/lojista/gestao/aluguel/pagar', ['parcela' => $parcela])
                        <tr>
                            <td>{{$parcela->parsequencia}}</td>
                            <td>{{$parcela->parvalor}}</td>
                            <td>{{date('d/m/Y', strtotime($parcela->pardatavencimento))}}</td>
                            <td>{{$situacoes[$parcela->parsituacao]}}</td>
                            <td style="display: flex; justify-content:end;">
                                @if($parcela->parsituacao == 1 && $parcela->tbaluguel->alusituacao == 1)
                                    <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content seuBotaoDePagar" data-parcela-id="{{ $parcela->parsequencia }}" style="position: relative; bottom:0px;" title="Pagar">
                                        <i class="material-icons">attach_money</i>
                                    </button>    
                                @endif
                                @if($parcela->parsituacao == 2 && $parcela->tbaluguel->alusituacao == 1)
                                    <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content seuBotaoDeAberta" data-parcela-id="{{ $parcela->parsequencia }}" style="position: relative; bottom:0px;" title="Aberta">
                                        <i class="material-icons">money_off</i>
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
                    
                    $('.seuBotaoDePagar').click(function() {
                        var parsequencia = $(this).data('parcela-id'); 
                        var modalPagarParcela = $('#modalParcelaPaga_' + parsequencia).modal();
                        modalPagarParcela.modal('open');
                    });

                    $('.seuBotaoDeAberta').click(function() {
                        var parsequencia = $(this).data('parcela-id'); 
                        var modalAbrirParcela = $('#modalParcelaAberta_' + parsequencia).modal();
                        modalAbrirParcela.modal('open');
                    });
                });
        
            </script>
            <div class="row center">
                <a href="{{route('consultaAluguelLojista')}}" class="modal-close waves-effect waves-green btn-flat" style="background-color: orange !important; color:white !important;">Voltar</a>
            </div>              
    </div>

@endsection