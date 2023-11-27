<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Aluguel;
use App\Models\Veiculo;
use App\Models\Parcela;
use App\Models\User;
use App\Models\Plano;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservaController extends Controller {
    
    public function consultaReservaLojista(Request $request){
        $search = $request->input('search');
    
        $query = Reserva::query();
        
        $query->with('tbveiculo', 'tbplano', 'users'); // Eager load os relacionamentos
    
        // Filtrar as reservas pela loja do usuário logado
        $query->whereHas('tbveiculo', function ($q) {
            $q->where('lojcodigo', Auth::user()->lojcodigo);
        });
    
        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veinome', 'like', "%$search%");
            });
        }
    
        $reservas = $query->paginate(7); // Usar $query em vez de Reserva::with('users')
        $totalReservas = $reservas->total();
        $situacoes = [
            1 => 'Pendente',
            2 => 'Aceita',
            3 => 'Recusada'
        ];
    
        return view('site/lojista/gestao/reserva/consulta', compact('situacoes', 'reservas', 'totalReservas', 'search'));
    }

    public function aceitarReserva(Request $request, $id) {
        // Busque a reserva pelo ID
        $reserva = Reserva::findOrFail($id);

        // Cancelar todas as reservas de qualquer veículo de qualquer loja
        // que foram solicitadas entre a data de início e término da reserva que está sendo aceita
        $this->cancelarReservasConcorrentes($reserva);

        // Criar o aluguel com base nas informações da reserva
        $aluguel = $this->criarAluguel($reserva);
        $this->alteraSituacaoVeiculo($reserva);
        // Gerar parcelas para o aluguel
        $this->gerarParcelas($aluguel);

        $reserva->ressituacao = 2;
        $reserva->save();

        // Retornar para a consulta de reserva
        return redirect()->route('consultaReservaLojista')->with('sucesso', 'Reserva aceita com sucesso. Aluguel gerado!');
    }

    private function cancelarReservasConcorrentes($reserva) {
        // Implemente a lógica para cancelar reservas concorrentes aqui
        // Certifique-se de ajustar a condição conforme necessário
        Reserva::where('rescodigo', '!=', $reserva->rescodigo)
            ->where('ressituacao', '=', 1)
            ->where('resdatainicio', '<=', $reserva->resdatatermino)
            ->where('resdatatermino', '>=', $reserva->resdatainicio)
            ->update(['ressituacao' => 3]);
    }

    private function criarAluguel($reserva) {
        // Crie o aluguel com base nas informações da reserva
        $aluguel = Aluguel::create([
            'aludatainicio' => $reserva->resdatainicio,
            'aludatatermino' => $reserva->resdatatermino,
            'alusituacao' => 1,
            'aluquantidadeparcela' => $reserva->resquantidadeparcela, // Coloque o valor correto para a situação do aluguel
            'veicodigo' => $reserva->veicodigo,
            'usucodigo' => $reserva->usucodigo,
            'placodigo' => $reserva->placodigo,
        ]);

        return $aluguel;
    }

    private function alteraSituacaoVeiculo($reserva){
        $veiculo = Veiculo::find($reserva->tbveiculo->veicodigo);
        $veiculo->veisituacao = 2; // em uso
        $veiculo->save();
    }

    private function gerarParcelas($aluguel) {
        // Obter a quantidade de parcelas e valor do plano da reserva
        $quantidadeParcelas = $aluguel->aluquantidadeparcela;
        $valorPlano = $aluguel->tbplano->plavalor;

        // Calcular o valor de cada parcela
        $valorParcela = $valorPlano / $quantidadeParcelas;

        // Calcular a data de vencimento (dia 10 do próximo mês)
        $dataVencimento = Carbon::now()->addMonthNoOverflow()->startOfMonth()->addDays(9);

        // Gerar as parcelas
        for ($i = 1; $i <= $quantidadeParcelas; $i++) {
            Parcela::create([
                'parsequencia' => $i,
                'alucodigo' => $aluguel->alucodigo,
                'parsituacao' => 1, // Coloque o valor correto para a situação da parcela
                'parvalor' => $valorParcela,
                'pardatavencimento' => $dataVencimento,
            ]);

            // Avançar para o próximo mês
            $dataVencimento->addMonth();
        }
    }

    public function recusarReserva(Request $request, $id){
        $reserva = Reserva::find($id);
        $reserva->ressituacao = 3;// recusada
        $reserva->save();
        return redirect()->route('consultaReservaLojista')->with('sucesso', 'Reserva recusada com sucesso.');
    }

    public function consultaReservaCliente(Request $request){
        $search = $request->input('search');
        $usucodigo = Auth::user()->id;

        $podeSolicitar = !$this->usuarioTemAluguelAtivo($usucodigo);

        $query = Reserva::query();
        $query->with('tbveiculo', 'tbplano', 'users');
        $query->where('usucodigo', $usucodigo);

        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veinome', 'like', "%$search");
            });
        }

        $situacoes = [
            1 => 'Pendente',
            2 => 'Aceita',
            3 => 'Recusada'
        ];

        $reservas = $query->paginate(7);
        $totalReservas = $reservas->total();

        return view('site/cliente/gestao/reserva/consulta', compact('reservas', 'totalReservas', 'search', 'situacoes', 'podeSolicitar'));
    }

    private function usuarioTemAluguelAtivo($usucodigo){
        $query = Aluguel::query();
        $query->where('usucodigo', $usucodigo);
        $query->where('alusituacao', 1);
        return $query->exists();
    }

    public function consultaVeiculosReserva(){
        $veiculos = Veiculo::with('tbloja', 'tbmarca')
                           ->where('veisituacao', 1)
                           ->get();
        
        // Carregar planos associados à loja para cada veículo
        $veiculos->each(function ($veiculo) {
            $veiculo->tbloja->load('tbplano');
        });
    
        return view('site/cliente/gestao/reserva/solicitar', compact('veiculos'));
    }

    public function validaInclusaoReserva(Request $request){
        $bValido = $request->validate([
            'veicodigo'         => ['required'],
            'placodigo'         => ['required'],
            'resdatainicio'     => ['required', 'date', 'after_or_equal:' . now()->addDays(7)->toDateString()],
            'resdatatermino'    => ['required', 'date', 'after:resdatainicio'],
        ], [
            'veicodigo.required'         => 'O Veículo é obrigatório!',
            'placodigo.required'         => 'O campo Plano é obrigatório!',
            'resdatainicio.required'     => 'O campo Data Início é obrigatório!',
            'resdatatermino.required'    => 'O campo Data Término é obrigatório!',
            'resdatainicio.after_or_equal' => 'A reserva deve ser solicitada com 7 dias de antecedência!',
            'resdatatermino.after'       => 'A data de término deve ser maior que a data de início.',
        ]);
    
        return response()->json(['isValid' => $bValido, 'errors' => $bValido ? [] : $validator->errors()->toArray()]);
    }
    
    public function incluirReserva(Request $request){
        // preciso adicionar uma coluna de resquantidadeparcela
        $reservaData = [
            'veicodigo' => $request->input('veicodigo'),
            'placodigo' => $request->input('placodigo'),
            'usucodigo' => Auth::user()->id,
            'resdatainicio' => $request->input('resdatainicio'),
            'resdatatermino' => $request->input('resdatatermino'),
            'resquantidadeparcela' => $request->input('plaquantidadeparcela'),
            'ressituacao'   => 1
        ];

        Reserva::create($reservaData);
        return redirect()->route('consultaReservaCliente')->with('sucesso', 'Reserva solicitada com sucesso.');
    }

}
