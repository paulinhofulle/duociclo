@extends('site/administrador/menu')
@section('title', 'Duociclo')

@section('conteudo')
    <div class="row container">
        <section class="info">
            <div class="col s12 m6">
                <article class="bg-gradient-green card z-depth-4 ">
                    <i class="material-icons">store</i>
                    <p>Lojas</p>
                    <h3>{{$qtdeLojas}}</h3>       
                </article>
            </div>
            <div class="col s12 m6">
                <article class="bg-gradient-blue card z-depth-4 ">
                    <i class="material-icons">person</i>
                    <p>Usuários</p>
                    <h3>{{$qtdeUsuarios}}</h3>           
                </article>
            </div>
        </section>        
    </div>
    
    
    <div class="row container ">
        <section class="graficos col s12 m6">            
            <div class="grafico card z-depth-4">
                <h5 class="center"> Lojas </h5>
                <canvas id="graficoLoja" width="400" height="200"></canvas> 
            </div>            
        </section>
        <section class="graficos col s12 m6" >            
            <div class="grafico card z-depth-4">
                <h5 class="center"> Usuários</h5>
                <canvas id="graficoUsuario" width="400" height="200"></canvas>
            </div>           
        </section>              
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{asset('js/chart.js')}}" ></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script>
        var ctx = document.getElementById('graficoLoja');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                         'Janeiro',
                         'Feveiro', 
                         'Março', 
                         'Abril', 
                         'Maio', 
                         'Junho', 
                         'Julho', 
                         'Agosto',
                         'Setembro',
                         'Outubro',
                         'Novembro',
                         'Dezembro'],
                datasets: [{
                    label: new Date().getFullYear(),
                    data: [{{$lojaData}}],
                    backgroundColor: [
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                        'rgba(0, 200, 83, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                    ],
                    borderWidth: 1, 
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            stepSize: 1,
                        }
                    }]
                }
            }
        });
    
        /* Gráfico 02 */
        var ctx = document.getElementById('graficoUsuario');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                         'Janeiro',
                         'Feveiro', 
                         'Março', 
                         'Abril', 
                         'Maio', 
                         'Junho', 
                         'Julho', 
                         'Agosto',
                         'Setembro',
                         'Outubro',
                         'Novembro',
                         'Dezembro'],
                datasets: [{
                    label: new Date().getFullYear(),
                    data: [{{$usuarioData}}],
                    backgroundColor: [
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                        'rgba(0, 145, 234, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(255, 152, 0, 1)',
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                            stepSize: 1,
                        }
                    }]
                }
            }
        });
    </script>
@endsection
