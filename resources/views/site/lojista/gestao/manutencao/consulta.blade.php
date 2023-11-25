@extends('site/lojista/menu')
@section('title', 'Duociclo - Manutenções')

@section('conteudo')
    <div class="row container crud">
            <div class="row titulo ">              
              <h1 class="left" style="color: #ff9800; font-weight:500; text-transform:none;">Manutenções</h1>
              <span class="right chip">{{$totalManutencoes}} manutenções cadastradas</span>  
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
                <a id="openModalBtnIncluir" href="#modalIncluirManutencao" class="btn modal-trigger" style="background-color: green; border-color: white; color: white; margin-bottom: 1rem;">
                    <i class="material-icons left">add</i>Incluir
                </a>
            </div>

            @include('site/lojista/gestao/manutencao/incluir')

           <nav class="bg-gradient-orange">
            <div class="nav-wrapper">
              <form action="{{ route('consultaManutencao') }}" method="GET">
                <div class="input-field">
                    <input placeholder="Pesquisar pela Descrição..." id="search" type="search" name="search" value="{{ $search }}">
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
                    <th>Descrição</th>
                    <th>Data Início</th>
                    <th>Data Término</th>
                    <th>Valor</th>
                    <th>Situação</th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($manutencoes as $manutencao)
                    @include('site/lojista/gestao/manutencao/visualizar', ['manutencao' => $manutencao])
                    @include('site/lojista/gestao/manutencao/alterar', ['manutencao' => $manutencao])
                    @include('site/lojista/gestao/manutencao/finalizar', ['manutencao' => $manutencao])
                    <tr>
                        <td>{{$manutencao->mancodigo}}</td>
                        <td>{{$manutencao->mandescricao}}</td>
                        <td>{{ date('d/m/Y', strtotime($manutencao->mandatainicio)) }}</td>
                        <td>@if ($manutencao->mandatatermino == null)
                                -
                            @else
                                {{ date('d/m/Y', strtotime($manutencao->mandatatermino)) }}
                            @endif 
                        </td>
                        <td>{{ number_format($manutencao->manvalor, 2, ',', '.') }}</td>
                        <td>{{$situacoes[$manutencao->mansituacao]}}</td>
                        <td style="display: flex; justify-content:end;">
                            @if ($manutencao->mansituacao == 1)
                                <button class="btn-floating halfway-fab waves-effect waves-light orange secondary-content seuBotaoDeAlteracao" data-manutencao-id="{{ $manutencao->mancodigo }}" style="position: relative; bottom:0px;" title="Alterar">
                                    <i class="material-icons">build</i>
                                </button>
                            @endif
                            <form action="{{ route('excluirManutencao', ['id' => $manutencao->mancodigo]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $manutencao->mancodigo }}">
                                <button class="btn-floating halfway-fab waves-effect waves-light red secondary-content" title="Excluir" style="position: relative; bottom:0px;"><i class="material-icons">delete</i></button>
                            </form>
                            <button class="btn-floating halfway-fab waves-effect waves-light blue secondary-content btn modal-trigger seuBotaoDeVisualizacao" title="Visualizar" style="position: relative; bottom:0px;" data-manutencao-id="{{ $manutencao->mancodigo }}">
                                <i class="material-icons">remove_red_eye</i>
                            </button>
                            @if ($manutencao->mansituacao == 1)
                                <button class="btn-floating halfway-fab waves-effect waves-light green secondary-content btn modal-trigger seuBotaoDeFinalizar" title="Finalizar" style="position: relative; bottom:0px;" data-manutencao-id="{{ $manutencao->mancodigo }}">
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
                var manutencoes = @json($manutencoes).data;
                var veiculos    = @json($veiculos);

                $(document).ready(function() {
                    //INCLUIR
                    var modalIncluirManutencao = $('#modalIncluirManutencao').modal();
                    modalIncluirManutencao[0].style.maxHeight = '100%';
                    $("#openModalBtnIncluir").click(function() {
                        modalIncluirManutencao.modal("open");
                        $('.error-message').remove();
                        limparCamposModalIncluir();
                        limparClassesCampos();
                    });
        
                    modalIncluirManutencao.modal({
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
                    var modalVisualizarManutencao = $('#modalVisualizarManutencao').modal();
                    modalVisualizarManutencao[0].style.maxHeight = '80%';
                    $('.seuBotaoDeVisualizacao').click(function() {
                        var mancodigo = $(this).data('manutencao-id'); // Obtém o ID da loja do atributo data-loja-id
                        var manutencao = encontrarManutencaoPorId(mancodigo); // Encontra a loja correspondente no array de lojas
                        preencherModalVisualizar(manutencao); // Preenche o modal de visualização com os dados da loja
                        modalVisualizarManutencao.modal('open');
                    });

                    function encontrarManutencaoPorId(id) {
                        return manutencoes.find(function(manutencao) {
                            return manutencao.mancodigo === id;
                        });
                    };

                    function encontrarVeiculoPorId(id) {
                        return veiculos.find(function(veiculo) {
                            return veiculo.veicodigo === id;
                        });
                    };

                    function preencherModalVisualizar(manutencao) {
                        var veiculo      = encontrarVeiculoPorId(manutencao.veicodigo);
                        var sDescricao   = 'Nenhum veículo selecionado!';
                        var sDataTermino = manutencao.mandatatermino !== null ? manutencao.mandatatermino : 'Não definido!';
                        $('#modalVisualizarManutencao .modal-content').append('<h4 class="center">Visualizar</h4>');
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Descrição:</b> ' + manutencao.mandescricao + '</p>');
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Valor:</b> ' + manutencao.manvalor + '</p>');
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Data de Início:</b> ' + manutencao.mandatainicio + '</p>');
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Data de Término:</b> ' + sDataTermino + '</p>');
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Observação:</b> ' + manutencao.manobservacao + '</p>');
                        if(veiculo){
                            sDescricao = veiculo.veicodigo + ' - ' + veiculo.veidescricao;
                        }
                        $('#modalVisualizarManutencao .modal-content').append('<p><b>Veículo:</b> ' + sDescricao + '</p>');
                    };

                    //ALTERAR
                    $('.seuBotaoDeAlteracao').click(function() {
                        var mancodigo = $(this).data('manutencao-id'); // Obtém o ID da loja do atributo data-loja-id
                        var manutencao = encontrarManutencaoPorId(mancodigo);
                        var modalAlterarManutencao = $('#modalAlterarManutencao_' + mancodigo).modal();
                        modalAlterarManutencao[0].style.maxHeight = '50%';
                        modalAlterarManutencao.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                    $('#btnEnviarFormAlteracao').click(function() {
                        event.preventDefault();
                        $('#formAlterarManutencao').submit();
                    });

                    //FINALIZAR
                    $('.seuBotaoDeFinalizar').click(function() {
                        var mancodigo = $(this).data('manutencao-id'); // Obtém o ID da loja do atributo data-loja-id
                        var manutencao = encontrarManutencaoPorId(mancodigo);
                        var modalAlterarManutencao = $('#modalFinalizarManutencao_' + mancodigo).modal();
                        modalAlterarManutencao[0].style.maxHeight = '100%';
                        modalAlterarManutencao.modal('open');
                        $('.error-message').remove();
                        limparClassesCampos();
                    });

                });
        
            </script>
            <div class="row center">
                {{$manutencoes->links('custom/pagination')}}
            </div>              
    </div>

@endsection