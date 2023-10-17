<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Veiculo;
use App\Models\User;
use App\Models\Plano;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller {
    
    public function consultaReserva(Request $request){
        $search = $request->input('search');

        $query = Reserva::query();
        
        $query->with('tbveiculo', 'tbplano', 'user'); // Eager load os relacionamentos

        $query->whereHas('tbveiculo', function ($q) {
            $q->where('lojcodigo', Auth::user()->lojcodigo);
        });

        if ($search) {
            $query->whereHas('tbveiculo', function ($q) use ($search) {
                $q->where('veinome', 'like', "%$search");
            });
        }

        $reservas = $query->paginate(7);
        $totalReservas = $reservas->total();

        return view('site/lojista/gestao/reserva/consulta', compact('reservas', 'totalReservas', 'search'));
    }

    public function aceitarReserva(Request $request, $id){
        
    }

    public function finalizarReserva(Request $request, $id){

    }

}
