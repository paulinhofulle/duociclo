<?php

namespace App\Http\Controllers\Lojista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluguel;
use App\Models\Parcela;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AluguelController extends Controller {
   
    public function consultaAluguelLojista(Request $request){
        $search = $request->input('search');

        $query = Aluguel::query();
        
        $query->with('tbveiculo', 'tbplano', 'user');

        $query->whereHas('tbveiculo', function ($q) {
            $q->where('lojcodigo', Auth::user()->lojcodigo);
        });

        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veidescricao', 'like', "%$search");
            });
        }

        $situacoes = [
            1 => 'Em Andamento',
            2 => 'Finalizado'
        ];
        $alugueis = $query->paginate(7);
        $totalAlugueis = $alugueis->total();

        return view('site/lojista/gestao/aluguel/consulta', compact('alugueis', 'totalAlugueis', 'search', 'situacoes'));
    }

    public function consultaAluguelCliente(Request $request){
        $search = $request->input('search');
        $usucodigo = Auth::user()->id;
        $query = Aluguel::query();
        $query->with('tbveiculo', 'tbplano', 'user');
        $query->where('usucodigo', $usucodigo);

        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veinome', 'like', "%$search");
            });
        }

        $situacoes = [
            1 => 'Em Andamento',
            2 => 'Finalizado'
        ];
        $alugueis = $query->paginate(7);

        $totalAlugueis = $alugueis->total();

        return view('site/cliente/gestao/aluguel/consulta', compact('alugueis', 'totalAlugueis', 'search', 'situacoes'));
    }

    public function consultaParcelasAluguel($aluguel){
        $parcelas = Parcela::where('alucodigo', $aluguel)->get();
        $situacoes = [
            1 => 'Aberta',
            2 => 'Paga'
        ];
        return view('site/lojista/gestao/aluguel/parcela', compact('parcelas', 'situacoes'));
    }

    public function abrirParcela($parcela, $aluguel){
        $parcela = Parcela::where('alucodigo', $aluguel)
                          ->where('parsequencia', $parcela)
                          ->first();
        $parcela->parsituacao = 1;
        $parcela->save();
        return redirect()->route('consultaParcelasAluguel', ['aluguel' => $aluguel])->with('sucesso', 'Parcela aberta com sucesso.');
    }

    public function pagarParcela($parcela, $aluguel){
        $parcela = Parcela::where('alucodigo', $aluguel)
                          ->where('parsequencia', $parcela)
                          ->first();
        $parcela->parsituacao = 2;
        $parcela->save();
        return redirect()->route('consultaParcelasAluguel', ['aluguel' => $aluguel])->with('sucesso', 'Parcela paga com sucesso.');
    }

    public function finalizarAluguel($aluguel){
        $aluguel = Aluguel::find($aluguel);
        $aluguel->alusituacao = 2;
        $aluguel->save();

        $veiculo = Veiculo::find($aluguel);
        $veiculo->veisituacao = 1;
        $veiculo->save();

        return redirect()->route('consultaAluguelLojista')->with('sucesso', 'Aluguel finalizado com sucesso.');
    }

}
