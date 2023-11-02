<?php

namespace App\Http\Controllers\Lojista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluguel;
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
                $q->where('veinome', 'like', "%$search");
            });
        }

        $alugueis = $query->paginate(7);
        $totalAlugueis = $alugueis->total();

        return view('site/lojista/gestao/aluguel/consulta', compact('alugueis', 'totalAlugueis', 'search'));
    }

    public function consultaAluguelCliente(Request $request){
        $search = $request->input('search');
        $usucodigo = Auth::user()->usucodigo;
        $query = Aluguel::query();
        $query->with('tbveiculo', 'tbplano', 'user');
        $query->where('usucodigo', $usucodigo);

        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veinome', 'like', "%$search");
            });
        }

        $alugueis = $query->paginate(7);

        $totalAlugueis = $alugueis->total();

        return view('site/cliente/gestao/aluguel/consulta', compact('alugueis', 'totalAlugueis', 'search'));
    }

    public function parcela(){
        return view('site/cliente/gestao/aluguel/parcela');
    }

}
