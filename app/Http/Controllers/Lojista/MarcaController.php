<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller{
    
    public function consultaMarca(Request $request){
        $search = $request->input('search'); // Obter o termo de pesquisa da solicitação GET

        // Construir a consulta de marcas com base no termo de pesquisa
        $query = Marca::query();
    
        if ($search) {
            $query->where('marnome', 'like', "%$search%");
        }
        $query->where('lojcodigo', Auth::user()->lojcodigo);
        $marcas = $query->paginate(7); // Paginar os resultados
    
        $totalMarcas = $marcas->total(); // Obter o total de resultados
    
        return view('site/lojista/cadastro/marca/consulta', compact('marcas', 'totalMarcas', 'search'));
    }

    public function incluirMarca(Request $request){
        $aMarcaData = [
            'marnome'   => $request->input('marnome'),
            'lojcodigo' => Auth::user()->lojcodigo
        ];
        Marca::create($aMarcaData);
        return redirect()->route('consultaMarca')->with('sucesso', 'Marca incluída com sucesso.');
    }

    public function excluirMarca(Request $request, $id){
        $marca = Marca::find($id);
    
        if (!$marca) {
            return redirect()->route('consultaMarca')->with('erro', 'Marca não encontrada.');
        }
        $marca->delete();
    
        return redirect()->route('consultaMarca')->with('sucesso', 'Marca excluída com sucesso!');
    }

    public function alterarMarca(Request $request, $id){
        $marca = Marca::where('marcodigo', $id)
                      ->where('lojcodigo', Auth::user()->lojcodigo)
                      ->first();
        if (!$marca) {
            \Log::error("Marca não encontrada com ID: $id");
            return redirect()->route('consultaMarca')->with('erro', 'Marca não encontrada.');
        }
            
        $marca->marnome = $request->input('marnome');
        $marca->save();
        return redirect()->route('consultaMarca')->with('sucesso', 'Marca alterada com sucesso.');
    }

}
