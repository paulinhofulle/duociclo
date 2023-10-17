<?php

namespace App\Http\Controllers\Lojista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluguel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AluguelController extends Controller {
   
    public function consultaAluguel(Request $request){
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

}
