<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\LojaController;
use App\Http\Controllers\Administrador\UsuarioController;
use App\Http\Controllers\Lojista\LojistaController;
use App\Http\Controllers\Lojista\MarcaController;
use App\Http\Controllers\Lojista\VeiculoController;
use App\Http\Controllers\Lojista\PlanoController;
use App\Http\Controllers\Lojista\ManutencaoController;
use App\Http\Controllers\Lojista\ReservaController;
use App\Http\Controllers\Lojista\AluguelController;
use App\Http\Controllers\Cliente\ClienteController;

// LOGIN
Route::view('/', 'site/login')->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('login/auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// CADASTRAR
Route::get('/cadastrar', [LoginController::class, 'cadastrar'])->name('cadastrar');
Route::post('/registrar', [LoginController::class, 'registrar'])->name('registrar');
Route::post('/validaCadastro', [LoginController::class, 'validaCadastro']);
Route::post('/obter-endereco-por-cep', [EnderecoController::class, 'obterEnderecoPorCep']);


Route::group(['middleware' => ['auth']], function () {
    // ADMINISTRADOR
    Route::get('/administrador', [AdministradorController::class, 'menu'])->name('administrador');
    //loja
    Route::get('/administrador/lojas', [LojaController::class, 'consultaLoja'])->name('consultaLoja');
    Route::post('/administrador/lojas/incluir', [LojaController::class, 'incluirLoja'])->name('incluirLoja');
    Route::delete('/administrador/lojas/excluir/{id}', [LojaController::class, 'excluirLoja'])->name('excluirLoja');
    Route::put('administrador/lojas/alterar/{id}', [LojaController::class, 'alterarLoja'])->name('alterarLoja');
    Route::post('/administrador/lojas/validaAlteracaoLoja', [LojaController::class, 'validaAlteracaoLoja']);
    Route::post('/administrador/lojas/validaInclusaoLoja', [LojaController::class, 'validaInclusaoLoja']);
    //usuario
    Route::get('/administrador/usuarios', [UsuarioController::class, 'consultaUsuario'])->name('consultaUsuario');
    Route::post('/administrador/usuarios/incluir', [UsuarioController::class, 'incluirUsuario'])->name('incluirUsuario');
    Route::delete('/administrador/usuarios/excluir/{id}', [UsuarioController::class, 'excluirUsuario'])->name('excluirUsuario');
    Route::put('administrador/usuarios/alterar/{id}', [UsuarioController::class, 'alterarUsuario'])->name('alterarUsuario');
    Route::post('/administrador/usuarios/validaAlteracaoUsuario', [UsuarioController::class, 'validaAlteracaoUsuario']);
    Route::post('/administrador/usuarios/validaInclusaoUsuario', [UsuarioController::class, 'validaInclusaoUsuario']);

    //LOJISTA
    Route::get('/lojista', [LojistaController::class, 'menu'])->name('lojista');
    Route::get('/lojista/minhaLoja', [LojistaController::class, 'minhaLoja'])->name('minhaLoja');
    Route::put('/lojista/minhaLoja/alterar/{id}', [LojistaController::class, 'alterarMinhaLoja'])->name('alterarMinhaLoja');
    Route::get('/lojista/meuPerfil', [LojistaController::class, 'meuPerfil'])->name('meuPerfilLojista');
    Route::put('/lojista/meuPerfil/alterar/{id}', [LojistaController::class, 'alterarMeuPerfil'])->name('alterarMeuPerfilLojista');
    //marca
    Route::get('/lojista/marcas', [MarcaController::class, 'consultaMarca'])->name('consultaMarca');
    Route::post('/lojista/marcas/incluir', [MarcaController::class, 'incluirMarca'])->name('incluirMarca');
    Route::delete('/lojista/marcas/excluir/{id}', [MarcaController::class, 'excluirMarca'])->name('excluirMarca');
    Route::put('/lojista/marcas/alterar/{id}', [MarcaController::class, 'alterarMarca'])->name('alterarMarca');
    //veiculo
    Route::get('/lojista/veiculos', [VeiculoController::class, 'consultaVeiculo'])->name('consultaVeiculo');
    Route::post('/lojista/veiculos/incluir', [VeiculoController::class, 'incluirVeiculo'])->name('incluirVeiculo');
    Route::delete('/lojista/veiculos/excluir/{id}', [VeiculoController::class, 'excluirVeiculo'])->name('excluirVeiculo');
    Route::put('/lojista/veiculos/alterar/{id}', [VeiculoController::class, 'alterarVeiculo'])->name('alterarVeiculo');
    Route::post('/lojista/veiculos/validaInclusaoVeiculo', [VeiculoController::class, 'validaInclusaoVeiculo']);
    Route::post('/lojista/veiculos/validaAlteracaoVeiculo', [VeiculoController::class, 'validaAlteracaoVeiculo']);
    //plano
    Route::get('/lojista/planos', [PlanoController::class, 'consultaPlano'])->name('consultaPlano');
    Route::post('/lojista/planos/incluir', [PlanoController::class, 'incluirPlano'])->name('incluirPlano');
    Route::delete('/lojista/planos/excluir/{id}', [PlanoController::class, 'excluirPlano'])->name('excluirPlano');
    Route::put('/lojista/planos/alterar/{id}', [PlanoController::class, 'alterarPlano'])->name('alterarPlano');
    Route::post('/lojista/planos/validaInclusaoPlano', [PlanoController::class, 'validaInclusaoPlano']);
    Route::post('/lojista/planos/validaAlteracaoPlano', [PlanoController::class, 'validaAlteracaoPlano']);
    //aluguel
    Route::get('/lojista/alugueis', [AluguelController::class, 'consultaAluguelLojista'])->name('consultaAluguelLojista');
    //manutencao
    Route::get('/lojista/manutencoes', [ManutencaoController::class, 'consultaManutencao'])->name('consultaManutencao');
    Route::post('/lojista/manutencoes/incluir', [ManutencaoController::class, 'incluirManutencao'])->name('incluirManutencao');
    Route::delete('/lojista/manutencoes/excluir/{id}', [ManutencaoController::class, 'excluirManutencao'])->name('excluirManutencao');
    Route::put('/lojista/manutencoes/alterar/{id}', [ManutencaoController::class, 'alterarManutencao'])->name('alterarManutencao');
    Route::put('/lojista/manutencoes/finalizar/{id}', [ManutencaoController::class, 'finalizarManutencao'])->name('finalizarManutencao');
    //reserva
    Route::get('/lojista/reservas', [ReservaController::class, 'consultaReservaLojista'])->name('consultaReservaLojista');
    Route::put('/lojista/reservas/aceitar/{id}', [ReservaController::class, 'aceitarReserva'])->name('aceitarReserva');
    Route::put('/lojista/reservas/recusar/{id}', [ReservaController::class, 'recusarReserva'])->name('recusarReserva');

    //CLIENTE
    Route::get('/cliente', [ClienteController::class, 'menu'])->name('cliente');
    Route::get('/cliente/meuPerfil', [ClienteController::class, 'meuPerfil'])->name('meuPerfilCliente');
    Route::put('/cliente/meuPerfil/alterar/{id}', [ClienteController::class, 'alterarMeuPerfil'])->name('alterarMeuPerfilCliente');
    //aluguel
    Route::get('/cliente/alugueis', [AluguelController::class, 'consultaAluguelCliente'])->name('consultaAluguelCliente');
    Route::get('/cliente/reservas', [ReservaController::class, 'consultaReservaCliente'])->name('consultaReservaCliente');





    Route::view('/parcelas', 'site/lojista/gestao/aluguel/parcela')->name('consultaParcelaLojista');
    Route::view('/solicitarReserva', 'site/cliente/gestao/reserva/solicitar')->name('reservaCliente');
});
