<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Plano;

class PlanoController extends Controller {
    
    public function consultaPlano(Request $request){
        $search = $request->input('search'); // Obter o termo de pesquisa da solicitação GET

        // Construir a consulta de marcas com base no termo de pesquisa
        $query = Plano::query();
    
        if ($search) {
            $query->where('pladescricao', 'like', "%$search%");
        }
        
        $query->where('lojcodigo', Auth::user()->lojcodigo);
        $planos = $query->paginate(7); // Paginar os resultados
        $totalPlanos = $planos->total(); // Obter o total de resultados
    
        return view('site/lojista/cadastro/plano/consulta', compact('planos', 'totalPlanos', 'search'));
    }

    public function validaInclusaoPlano(Request $request){
        $bValido = $request->validate([
            'pladescricao'          => ['required'],
            'plaquantidadedias'     => ['required'],
            'plavalor'              => ['required'],
            'plaquantidadeparcela' => ['required'],
        ],[
            'pladescricao.required'          => 'O campo Descrição é obrigatório!',
            'plaquantidadedias.required'     => 'O campo Quantidade de Dias é obrigatório!',
            'plavalor.required'              => 'O campo Valor é obrigatório!',
            'plaquantidadeparcela.required' => 'O campo Quantidade de Parcelas é obrigatório!',
        ]);
        return response()->json(['isValid' => $bValido, 'errors' => $bValido ? [] : $validator->errors()->toArray()]);
    }

    public function incluirPlano(Request $request){
        $aPlanoData = $request->all();
        $aPlanoData['plavalor']  = str_replace(',', '.', $request->input('plavalor'));
        $aPlanoData['lojcodigo'] = Auth::user()->lojcodigo;
        
        Plano::create($aPlanoData);
        
        return redirect()->route('consultaPlano')->with('sucesso', 'Plano incluído com sucesso.');
    }

    public function excluirPlano(Request $request, $id){
        $plano = Plano::find($id);
    
        if (!$plano) {
            return redirect()->route('consultaPlano')->with('erro', 'Plano não encontrado.');
        }
        $plano->delete();
    
        return redirect()->route('consultaPlano')->with('sucesso', 'Plano excluído com sucesso!');
    }

    public function validaAlteracaoPlano(Request $request){
        $bValido = $request->validate([
            'pladescricao'          => ['required'],
            'plaquantidadedias'     => ['required'],
            'plavalor'              => ['required'],
            'plaquantidadeparcela' => ['required'],
        ],[
            'pladescricao.required'          => 'O campo Descrição é obrigatório!',
            'plaquantidadedias.required'     => 'O campo Quantidade de Dias é obrigatório!',
            'plavalor.required'              => 'O campo Valor é obrigatório!',
            'plaquantidadeparcela.required' => 'O campo Quantidade de Parcelas é obrigatório!',
        ]);
        return response()->json(['isValid' => $bValido, 'errors' => $bValido ? [] : $validator->errors()->toArray()]);
    }

    public function alterarPlano(Request $request, $id){
        $plano = Plano::where('placodigo', $id)
                      ->where('lojcodigo', Auth::user()->lojcodigo)
                      ->first();
        if (!$plano) {
            \Log::error("Plano não encontrado com ID: $id");
            return redirect()->route('consultaPlano')->with('erro', 'Plano não encontrado.');
        }
        
        $plano->pladescricao = $request->input('pladescricao');
        $plano->save();
        return redirect()->route('consultaPlano')->with('sucesso', 'Plano alterado com sucesso.');
    }

}
