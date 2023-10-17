<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdministradorController extends Controller {
    /**
     * Listar
     */
    public function menu(){
        $qtdeUsuarios = User::where('usutipo', '!=', 1)->count();
        $qtdeLojas    = Loja::count();
        // Obtém o ano atual
        $anoAtual = Carbon::now()->year;

        // Consulta para obter a contagem de lojas por mês
        $lojaDados = Loja::select(
            \DB::raw('MONTH(created_at) as mes'),
            \DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', $anoAtual)
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->orderBy(\DB::raw('MONTH(created_at)'))
        ->get();

        // Consulta para obter a contagem de usuários por mês
        $usuarioDados = User::select(
            \DB::raw('MONTH(created_at) as mes'),
            \DB::raw('COUNT(*) as total')
        )
        ->where('usutipo', '!=', 1)
        ->whereYear('created_at', $anoAtual)
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->orderBy(\DB::raw('MONTH(created_at)'))
        ->get();

        $lojaTotal = [];
        foreach($lojaDados as $loja){
            $lojaTotal[] = $loja->total;
        }

        $usuarioTotal = [];
        foreach($usuarioDados as $usuario){
            $usuarioTotal[] = $usuario->total;
        }

        $lojaData = implode(',', $lojaTotal);
        $usuarioData = implode(',', $usuarioTotal);
        return view('site/administrador/painel', compact('qtdeLojas', 'qtdeUsuarios', 'lojaData', 'usuarioData'));
    }

    /**
     * Exibir formulário.
     */
    public function create()
    {
        //
    }

    /**
     * Salvar.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Exibir recurso especifico
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Exibe formulario para edição
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Alterar
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Excluir
     */
    public function destroy(string $id)
    {
        //
    }
}
