@extends('site/cliente/menu')
@section('title', 'Duociclo - Solicitar Reserva')

@section('conteudo')
    <div class="row container crud">

        <div class="row titulo ">              
            <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Veículos</h1>
            <a href="{{route('consultaReservaCliente')}}" class="modal-close waves-effect waves-green btn-flat" style="background-color: orange !important; color:white !important; margin-left:1rem;">Voltar</a>
        </div>
        
      
        <div class="row">
            @foreach ($veiculos as $veiculo)
                @include('site/cliente/gestao/reserva/incluirReserva', ['veiculo' => $veiculo])
                @include('site/cliente/gestao/reserva/visualizarLoja', ['veiculo' => $veiculo])
                @include('site/cliente/gestao/reserva/visualizarVeiculo', ['veiculo' => $veiculo])
                <div class="col s6 m3">
                    <div class="card">
                        <div class="card-image">
                            @if ($veiculo->veiimagem)
                                <img src="/img/veiculos/{{$veiculo->veiimagem}}" style="height: 10rem;">
                            @else
                                <span class="card-title">Sem imagem</span>
                            @endif
                            <a class="btn-floating waves-effect waves-light green right seuBotaoDeIncluirReserva" data-veiculo-id="{{ $veiculo->veicodigo }}" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                                <i class="material-icons left">add</i>Incluir
                            </a>
                            <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoVeiculo"  data-veiculo-id="{{ $veiculo->veicodigo }}"><i class="material-icons">motorcycle</i></a>
                            <a class="btn-floating waves-effect waves-light blue right seuBotaoDeVisualizacaoLoja" data-veiculo-id="{{ $veiculo->veicodigo }}"><i class="material-icons">store</i></a>
                            
                        </div>
                        <div class="card-content">
                            <p><b>Descrição:</b> {{$veiculo->veidescricao}}</p>
                            <p><b>Ano:</b> {{$veiculo->veiano}}</p>
                            <p><b>Cor:</b> {{$veiculo->veicor}}</p>
                            <p><b>KM:</b> {{$veiculo->veiquilometragem}}</p>
                            <p><b>Loja:</b> {{$veiculo->tbloja->lojnome}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
                $(document).ready(function() {
                    var veiculos = @json($veiculos);
                    
                    $(".seuBotaoDeIncluirReserva").click(function() {''
                        var veicodigo = $(this).data('veiculo-id'); // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo);
                        var modalIncluirReserva = $('#modalIncluirReserva_'+veicodigo).modal();
                        preencherModalIncluirReserva(veiculo);
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                        $('#modalIncluirReserva_'+veicodigo+' #resdatainicio').on('blur', function() {
                            var veicodigo = this.parentElement.parentElement.parentElement.parentElement.id.split('modalIncluirReserva_')[1];
                            ajustaValorDatas(veicodigo);
                        });

                        $('#modalIncluirReserva_'+veicodigo+' #placodigo').on('change', function (veicodigo) {
                            var veicodigo = +this.parentElement.parentElement.parentElement.parentElement.id.split('modalIncluirReserva_')[1];
                            if($('#modalIncluirReserva_'+veicodigo+' #resdatainicio').val()){
                                ajustaValorDatas(veicodigo);
                            }
                            // Preencher a lista de parcelas com base no plano selecionado
                            preencherListaParcelas(veicodigo, $(this).val());
                        });
                        modalIncluirReserva.modal("open");
                    });

                    function preencherModalIncluirReserva(veiculo) {
                        var veicodigo = veiculo.veicodigo;
                        $('#modalIncluirReserva_'+veicodigo+' #veicodigo').val(veiculo.veicodigo);
                        $('#modalIncluirReserva_'+veicodigo+' #veidescricao').val(veiculo.veidescricao).prop('disabled', true);
                        $('#modalIncluirReserva_'+veicodigo+' #resdatatermino_aux').prop('disabled', true);
                        $('label[for="veidescricao"]').addClass('active');
                        preencherListaPlanos(veicodigo, veiculo.tbloja.tbplano);
                    };

                    // Função para preencher a lista de planos
                    function preencherListaPlanos(veicodigo, planos) {
                        // Limpar opções existentes
                        $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').empty();
                        // Adicionar a opção padrão
                        $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').append('<option value="" selected>Selecione o plano...</option>');

                        // Adicionar opções com base nos planos disponíveis
                        planos.forEach(function (plano) {
                            $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').append('<option value="' + plano.placodigo + '">' + plano.pladescricao + ' ('+ plano.plaquantidadedias + ' dias)' + '</option>');
                        });
                        
                        $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').addClass('browser-default');
                    }

                    function preencherListaParcelas(veicodigo, planoId) {
                        // Obter o plano selecionado // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo);
                        var planos = veiculo.tbloja.tbplano;
                        var planoSelecionado = planos.find(function (plano) {
                            return plano.placodigo == planoId;
                        });

                        // Limpar opções existentes
                        $('#modalIncluirReserva_'+veicodigo+' select[name="plaquantidadeparcela"]').empty();

                        // Adicionar a opção padrão
                        $('#modalIncluirReserva_'+veicodigo+' select[name="plaquantidadeparcela"]').append('<option value="" selected>Selecione a quantidade de parcelas...</option>');

                        if(planoSelecionado){
                            // Adicionar opções com base na quantidade de parcelas do plano
                            for (var i = 1; i <= planoSelecionado.plaquantidadeparcela; i++) {
                                var valorParcela = planoSelecionado.plavalor / i;
                                $('#modalIncluirReserva_'+veicodigo+' select[name="plaquantidadeparcela"]').append('<option value="' + i + '">' + i + 'X de R$' + valorParcela.toFixed(2) + '</option>');
                            }
                        }
                    }

                    function ajustaValorDatas(veicodigo){
                        // Obtém a data de início selecionada
                        var valorDataInicio = $('#modalIncluirReserva_'+veicodigo+' #resdatainicio').val();
                        
                        // Converte a string da data de início para um objeto Date
                        var dataInicio = new Date(valorDataInicio);

                        // Verifica se a conversão foi bem-sucedida e a data de início é válida
                        if (!isNaN(dataInicio.getTime())) {
                            // Adiciona a quantidade de dias do plano de aula
                            var quantidadeDiasPlano = obterQuantidadeDiasPlano(veicodigo); // Implemente essa função
                            if(quantidadeDiasPlano > 0){
                                // Adiciona a quantidade de dias ao objeto Date
                                dataInicio.setDate(dataInicio.getDate() + quantidadeDiasPlano);

                                // Formata a data de término no formato desejado
                                var formattedDataTermino = formatDate(dataInicio); // Implemente essa função

                                // Define a data de término no campo correspondente
                                $('#modalIncluirReserva_'+veicodigo+' #resdatatermino_aux').val(formattedDataTermino);
                                $('#modalIncluirReserva_'+veicodigo+' #resdatatermino').val(formattedDataTermino);
                            }else{
                                $('#modalIncluirReserva_'+veicodigo+' #resdatatermino_aux').val('');
                                $('#modalIncluirReserva_'+veicodigo+' #resdatatermino').val('');
                            }
                            
                        } else {
                            // Caso a conversão da data de início tenha falhado, você pode tratar isso aqui
                            $('#modalIncluirReserva_'+veicodigo+' #resdatatermino_aux').val('');
                            $('#modalIncluirReserva_'+veicodigo+' #resdatatermino').val('');
                        }
                    }

                    // Restante do seu código...
                    
                    // Função para obter a quantidade de dias do plano de aula
                    function obterQuantidadeDiasPlano(veicodigo) { // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(+veicodigo);
                        var planoSelecionadoId = $('#modalIncluirReserva_'+veicodigo+' select[name="placodigo"]').val();
                        var listaPlanos = veiculo.tbloja.tbplano;

                        // Buscar o plano selecionado na lista de planos
                        var planoSelecionado = listaPlanos.find(function(plano) {
                            return plano.placodigo == planoSelecionadoId;
                        });
                        // Retornar a quantidade de dias do plano selecionado
                        return planoSelecionado ? planoSelecionado.plaquantidadedias : 0;
                    }

                    // Função para formatar a data no formato "dd/mm/yyyy"
                    function formatDate(date) {
                        var day = date.getDate();
                        var month = date.getMonth() + 1; // Adiciona 1 porque os meses começam do zero
                        var year = date.getFullYear();

                        // Formata os componentes da data com zero à esquerda, se necessário
                        day = day < 10 ? '0' + day : day;
                        month = month < 10 ? '0' + month : month;

                        // Retorna a data formatada no formato "yyyy-MM-dd"
                        return year + '-' + month + '-' + day;
                    }
                    
                    function limparCamposModalIncluir() {
                        $('select[name="placodigo"]').val('');
                        $('#resdatainicio').val('');
                        $('#resdatatermino_aux').val('');
                        $('select[name="plaquantidadeparcela"]').val('');
                    };
        
                    function limparClassesCampos() {
                        $('#resdatainicio')[0].className = 'validate';
                        $('#resdatatermino_aux')[0].className = 'validate';
                    };
                    
                    $("#btnFecharIncluir").click(function() {
                        limparCamposModalIncluir();
                    });

                    function encontrarVeiculoPorId(id) {
                        return veiculos.find(function(veiculo) {
                            return veiculo.veicodigo === id;
                        });
                    };
                    //VISUALIZAR
                    var modalVisualizarLojaReserva = $('#modalReservaVisualizarLoja').modal();
                    $('.seuBotaoDeVisualizacaoLoja').click(function() {
                        var veicodigo = +$(this).data('veiculo-id'); // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo);
                        preencherModalVisualizarLoja(veiculo); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarLojaReserva.modal('open');
                    });

                    function preencherModalVisualizarLoja(veiculo) {
                        var modalContent = $('#modalReservaVisualizarLoja .modal-content');
    
                        // Limpar conteúdo anterior
                        modalContent.empty();
                        $('#modalReservaVisualizarLoja .modal-content').html('');
                        $('#modalReservaVisualizarLoja .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Nome da Loja:</b> '+veiculo.tbloja.lojnome+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>CNPJ:</b> '+veiculo.tbloja.lojcnpj+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Telefone:</b> '+veiculo.tbloja.lojtelefone+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>E-mail:</b> '+veiculo.tbloja.lojemail+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>CEP:</b> '+veiculo.tbloja.lojcep+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Rua:</b> '+veiculo.tbloja.lojrua+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Bairro:</b> '+veiculo.tbloja.lojbairro+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Cidade:</b> '+veiculo.tbloja.lojcidade+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Estado:</b> '+veiculo.tbloja.lojestado+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>N° Endereço:</b> '+veiculo.tbloja.lojnumeroendereco+'</p>');
                        $('#modalReservaVisualizarLoja .modal-content').append('<p><b>Complemento Endereço:</b> '+veiculo.tbloja.lojcomplementoendereco+'</p>');
                    };

                    var modalVisualizarVeiculoReserva = $('#modalReservaVisualizarVeiculo').modal();
                    $('.seuBotaoDeVisualizacaoVeiculo').click(function() {
                        var veicodigo = $(this).data('veiculo-id'); // Obtém o ID da loja do atributo data-loja-id
                        var veiculo = encontrarVeiculoPorId(veicodigo);
                        preencherModalVisualizarVeiculo(veiculo); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarVeiculoReserva.modal('open');
                    });

                    function preencherModalVisualizarVeiculo(veiculo) {
                        var modalContent = $('#modalReservaVisualizarVeiculo .modal-content');
    
                        // Limpar conteúdo anterior
                        modalContent.empty();
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Descrição:</b> '+veiculo.veidescricao+'</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Cor:</b> ' +veiculo.veicor+'</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Ano:</b> '+veiculo.veiano+'</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>KM:</b> '+veiculo.veiquilometragem+'</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Placa:</b> '+veiculo.veiplaca+'</p>');
                        $('#modalReservaVisualizarVeiculo .modal-content').append('<p><b>Marca:</b> '+veiculo.tbmarca.marnome+'</p>');
                    };
                    
                });
        
            </script>
@endsection