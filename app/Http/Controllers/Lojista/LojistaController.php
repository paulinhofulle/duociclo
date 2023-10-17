<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Models\Aluguel;
use App\Models\Manutencao;
use App\Models\Marca;
use App\Models\Loja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LojistaController extends Controller {
    
    public function menu(){
        $lucro = Aluguel::where('alusituacao', 2)->sum('aluvalor');
        $gasto = Manutencao::where('mansituacao', 2)
                           ->whereHas('tbveiculo', function($query) {
                                      $query->where('lojcodigo', Auth::user()->lojcodigo);
                                     })
                           ->sum('manvalor');
    
        $anoAtual = Carbon::now()->year;
        $aluguelDados = Aluguel::select(
            \DB::raw('MONTH(created_at) as mes'),
            \DB::raw('COUNT(*) as total')
        )
        ->where('alusituacao', 2)
        ->whereYear('created_at', $anoAtual)
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->orderBy(\DB::raw('MONTH(created_at)'))
        ->get();

        // Consulta para obter a contagem de usuários por mês
        $manutencaoDados = Manutencao::select(
            \DB::raw('MONTH(created_at) as mes'),
            \DB::raw('COUNT(*) as total')
        )
        ->where('mansituacao', 2)
        ->whereYear('created_at', $anoAtual)
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->orderBy(\DB::raw('MONTH(created_at)'))
        ->get();

        $aluguelTotal = [];
        foreach($aluguelDados as $aluguel){
            $aluguelTotal[] = $aluguel->total;
        }

        $manutencaoTotal = [];
        foreach($manutencaoDados as $manutencao){
            $manutencaoTotal[] = $manutencao->total;
        }

        $aluguelData = implode(',', $aluguelTotal);
        $manutencaoData = implode(',', $manutencaoTotal);
        return view('site/lojista/painel', compact('lucro', 'gasto', 'aluguelData', 'manutencaoData'));
    }

    public function minhaLoja(){
        $loja = Loja::find(Auth::user()->lojcodigo);
        return view('site/lojista/minhaLoja', compact('loja'));
    }

    public function alterarMinhaLoja(Request $request, $id){
        $bValido = $request->validate([
            'lojtelefone'           => ['required'],
            'lojcep'                => ['required', 'min:8'],
            'lojnumeroendereco'     => ['required', 'numeric'],
            'lojcomplemento'        => ['nullable']
        ],[
            'lojtelefone.required'       => 'O campo Telefone é obrigatório!',
            'lojnumeroendereco.required' => 'O campo N° Endereço é obrigatório!',
            'lojnumeroendereco.numeric'  => 'O campo N° Endereço deve ser numérico!',
            'lojcep.required'            => 'O campo CEP é obrigatório!',
            'lojcep.min'                 => 'O campo CEP deve ter 8 números!'
        ]);
    
        if($bValido){
            $loja = Loja::find($id);
            if (!$loja) {
                \Log::error("Loja não encontrada com ID: $id");
                return redirect()->route('consultaLoja')->with('erro', 'Loja não encontrada.');
            }
            
            $loja->lojnumeroendereco = $request->input('lojnumeroendereco');
            $loja->lojtelefone = $request->input('lojtelefone');
            $loja->lojemail = $request->input('lojemail');
            $loja->lojcep = $request->input('lojcep');
            $loja->lojcomplementoendereco = $request->input('lojcomplementoendereco');
    
            $loja->save();
    
            return redirect()->route('lojista')->with('sucessoHome', 'Informações da loja alteradas com sucesso.');
        }
    }

    public function meuPerfil(){
        $usuario = User::find(Auth::user()->id);
        return view('site/lojista/meuPerfil', compact('usuario'));
    }

    public function alterarMeuPerfil(Request $request, $id){
        $bValido = $request->validate([
            'usutelefone'           => ['required'],
            'usucep'                => ['required', 'min:8'],
            'usunumeroendereco'     => ['required', 'numeric'],
            'usucomplemento'        => ['nullable']
        ],[
            'usutelefone.required'       => 'O campo Telefone é obrigatório!',
            'usucep.required'            => 'O campo CEP é obrigatório!',
            'usucep.min'                 => 'O campo CEP deve ter 8 números!',
            'usunumeroendereco.required' => 'O campo N° Endereço é obrigatório!',
            'usunumeroendereco.numeric'  => 'Só deve ser informado números!',
        ]);
    
        if($bValido){
            $usuario = User::find($id);
            if (!$usuario) {
                \Log::error("Usuário não encontrado com ID: $id");
                return redirect()->route('consultaUsuario')->with('erro', 'Usuário não encontrado.');
            }
            
            $usuario->usutelefone            = $request->input('usutelefone');
            $usuario->usucep                 = $request->input('usucep');
            $usuario->usunumeroendereco      = $request->input('usunumeroendereco');
            $usuario->usucomplementoendereco = $request->input('usucomplementoendereco');
    
            $usuario->save();
    
            return redirect()->route('lojista')->with('sucessoHome', 'Usuário alterado com sucesso.');
        }
        else{
            return redirect()->route('lojista')->with('erro', 'Usuário não encontrado.');
        }
    }

}
