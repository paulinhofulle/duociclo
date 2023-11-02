<?php

namespace App\Http\Controllers\Lojista;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manutencao;
use App\Models\Veiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManutencaoController extends Controller {
    
    public function consultaManutencao(Request $request){
        $search = $request->input('search'); // Obter o termo de pesquisa da solicitação GET

        // Construir a consulta de marcas com base no termo de pesquisa
        $query = Manutencao::query();
    
        if ($search) {
            $query->where('mandescricao', 'like', "%$search%");
        }
        $query->whereHas('tbveiculo', function ($q) {
            $q->where('lojcodigo', Auth::user()->lojcodigo);
        });
        $manutencoes = $query->paginate(7); // Paginar os resultados
        $totalManutencoes = $manutencoes->total(); // Obter o total de resultados
        $veiculosDisponiveis = Veiculo::all()
                           ->where('veisituacao', '=', 1)
                           ->where('lojcodigo', '=', Auth::user()->lojcodigo);
        $veiculos = Veiculo::all()
                           ->where('lojcodigo', '=', Auth::user()->lojcodigo);

        $situacoes = [
            1 => 'Em Andamento',
            2 => 'Finalizado'
        ];
    
        return view('site/lojista/gestao/manutencao/consulta', compact('situacoes', 'manutencoes', 'totalManutencoes', 'search', 'veiculos', 'veiculosDisponiveis'));
    }

    public function incluirManutencao(Request $request){
        $aManutencaoData = $request->all();
        $aManutencaoData['manvalor']  = str_replace(',', '.', $request->input('manvalor'));
        $aManutencaoData['mansituacao'] = 1;// em execução
        Manutencao::create($aManutencaoData);
        $this->alteraSituacaoVeiculo($request->veicodigo, 3);
        //fazer aqui alteração da situação do veiculo
        return redirect()->route('consultaManutencao')->with('sucesso', 'Manutenção incluída com sucesso.');
    }

    private function alteraSituacaoVeiculo($veicodigo, $situacao){
        $veiculo = Veiculo::find($veicodigo);
        $veiculo->veisituacao = $situacao;
        $veiculo->save();
    }

    public function excluirManutencao(Request $request, $id){
        $manutencao = Manutencao::find($id);
    
        if (!$manutencao) {
            return redirect()->route('consultaManutencao')->with('erro', 'Manutenção não encontrada.');
        }
        $manutencao->delete();
        $this->alteraSituacaoVeiculo($manutencao->veicodigo, 1);
    
        return redirect()->route('consultaManutencao')->with('sucesso', 'Manutenção excluída com sucesso!');
    }

    public function alterarManutencao(Request $request, $id){
        $manutencao = Manutencao::find($id);
        if (!$manutencao) {
            \Log::error("Manutenção não encontrada com ID: $id");
            return redirect()->route('consultaManutencao')->with('erro', 'Manutenção não encontrada.');
        }

        $manutencao->mandescricao  = $request->input('mandescricao');
        $manutencao->manvalor      = str_replace(',', '.', $request->input('manvalor'));
        $manutencao->mandatainicio = $request->input('mandatainicio');
        $manutencao->manobservacao = $request->input('manobservacao');
        $manutencao->save();
        return redirect()->route('consultaManutencao')->with('sucesso', 'Manutenção alterada com sucesso.');
    }

    public function finalizarManutencao(Request $request, $id){
        $manutencao = Manutencao::find($id);
        if (!$manutencao) {
            \Log::error("Manutenção não encontrada com ID: $id");
            return redirect()->route('consultaManutencao')->with('erro', 'Manutenção não encontrada.');
        }
        
        $manutencao->mandatatermino = $request->input('mandatatermino');
        $manutencao->mansituacao    = 2; // finalizado
        $manutencao->save();
        $this->alteraSituacaoVeiculo($manutencao->veicodigo, 1);
        return redirect()->route('consultaManutencao')->with('sucesso', 'Manutenção finalizada com sucesso.');
    }

}
