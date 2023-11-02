<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Veiculo;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;

class VeiculoController extends Controller{

    public function consultaVeiculo(Request $request){
        $search = $request->input('search'); // Obter o termo de pesquisa da solicitação GET

        // Construir a consulta de marcas com base no termo de pesquisa
        $query = Veiculo::query();
    
        if ($search) {
            $query->where('veidescricao', 'like', "%$search%");
        }
        
        $query->where('lojcodigo', Auth::user()->lojcodigo);
        $veiculos = $query->paginate(7); // Paginar os resultados
        $totalVeiculos = $veiculos->total(); // Obter o total de resultados
        $marcas = Marca::all()
                       ->where('lojcodigo', Auth::user()->lojcodigo);

        $situacoes = [
                        1 => 'Disponível',
                        2 => 'Em Uso',
                        3 => 'Em Manutenção',
                    ];
    
        return view('site/lojista/cadastro/veiculo/consulta', compact('veiculos', 'totalVeiculos', 'search', 'marcas', 'situacoes'));
    }

    public function incluirVeiculo(Request $request) {
        $aVeiculoData = $request->all();
        
        //if ($request->hasFile('veiimagem')) {
        //    $aVeiculoData['veiimagem'] = $request->file('veiimagem')->store('veiculos', 'public');
       // }
        $aVeiculoData['veisituacao'] = 1;
        $aVeiculoData['lojcodigo']   = Auth::user()->lojcodigo;
        
        Veiculo::create($aVeiculoData);
        
        return redirect()->route('consultaVeiculo')->with('sucesso', 'Veículo incluído com sucesso.');
    }

    public function excluirVeiculo(Request $request, $id){
        $veiculo = Veiculo::find($id);
    
        if (!$veiculo) {
            return redirect()->route('consultaVeiculo')->with('erro', 'Veículo não encontrado.');
        }
        $veiculo->delete();
    
        return redirect()->route('consultaVeiculo')->with('sucesso', 'Veículo excluído com sucesso!');
    }

    public function alterarVeiculo(Request $request, $id){
        $veiculo = Veiculo::where('veicodigo', $id)
                      ->where('lojcodigo', Auth::user()->lojcodigo)
                      ->first();
        if (!$veiculo) {
            \Log::error("Veículo não encontrado com ID: $id");
            return redirect()->route('consultaVeiculo')->with('erro', 'Veículo não encontrado.');
        }
            
        $veiculo->veikm = $request->input('veikm');
        $veiculo->veiplaca = $request->input('veiplaca');
        $veiculo->veicor = $request->input('veicor');
        $veiculo->veidescricao = $request->input('veidescricao');
        //if ($request->hasFile('veiimagem')) {
        //    $veiculo->veiimagem = $request->file('veiimagem')->store('veiculos', 'public');
       // }
        $veiculo->save();
        return redirect()->route('consultaVeiculo')->with('sucesso', 'Veiculo alterado com sucesso.');
    }

}
