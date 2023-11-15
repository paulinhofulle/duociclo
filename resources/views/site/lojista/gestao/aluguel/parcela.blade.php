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
                 
                      <tr>
                        <td>1</td>
                        <td>R$500,00</td>
                        <td>10/11/2023</td>
                        <td>Aberta</td>
                        <td style="display: flex; justify-content:end;">
                            <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content seuBotaoDeParcelas" style="position: relative; bottom:0px;" title="Pagar">
                                <i class="material-icons">attach_money</i>
                            </button>
                            <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content seuBotaoDeAceitar" style="position: relative; bottom:0px;" title="Aberta">
                              <i class="material-icons">money_off</i>
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
                    
                    
                });
        
            </script>
            <div class="row center">
                <a href="{{route('consultaAluguelLojista')}}" class="modal-close waves-effect waves-green btn-flat" style="background-color: orange !important; color:white !important;">Voltar</a>
            </div>              
    </div>

@endsection