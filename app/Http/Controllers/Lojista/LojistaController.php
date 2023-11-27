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
use Illuminate\Support\Facades\Hash;

class LojistaController extends Controller {
    
    public function menu(){
        $lucro = Aluguel::join('tbplano', 'tbaluguel.placodigo', '=', 'tbplano.placodigo')
                        ->join('tbveiculo', 'tbaluguel.veicodigo', '=', 'tbveiculo.veicodigo')
                        ->where('tbaluguel.alusituacao', 2)
                        ->where('tbveiculo.lojcodigo', Auth::user()->lojcodigo)
                        ->sum('tbplano.plavalor');
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
            $loja->lojrua = $request->input('lojrua');
            $loja->lojbairro = $request->input('lojbairro');
            $loja->lojcidade = $request->input('lojcidade');
            $loja->lojestado = $request->input('lojestado');
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
            'usucomplemento'        => ['nullable'],
            'password'              => ['nullable', 'required_with:newpassword,newpassword_confirmation'],
            'newpassword'           => ['nullable', 'confirmed', 'regex:/^[a-zA-Z0-9]{6,20}$/'],
        ], [
            'usutelefone.required'       => 'O campo Telefone é obrigatório!',
            'usucep.required'            => 'O campo CEP é obrigatório!',
            'usucep.min'                 => 'O campo CEP deve ter 8 números!',
            'usunumeroendereco.required' => 'O campo N° Endereço é obrigatório!',
            'usunumeroendereco.numeric'  => 'Só deve ser informado números!',
            'password.required_with'     => 'A senha atual é obrigatória quando informar Nova Senha!',
            'newpassword.confirmed'      => 'A confirmação da nova senha não coincide!',
            'newpassword.regex'          => 'A nova senha deve ter entre 6 e 20 caracteres alfanuméricos!',
        ]);
    
        $usuario = User::find($id);
        if (!$usuario) {
            \Log::error("Usuário não encontrado com ID: $id");
            return redirect()->route('consultaUsuario')->with('erro', 'Usuário não encontrado.');
        }
    
        // Verificar se a senha atual está correta
        if ($request->filled('password') && !Hash::check($request->input('password'), $usuario->password)) {
            return redirect()->back()->with('erro', 'Senha atual incorreta.');
        }
    
        // Atualizar os dados do usuário
        $usuario->usutelefone            = $request->input('usutelefone');
        $usuario->usucep                 = $request->input('usucep');
        $usuario->usurua                 = $request->input('usurua');
        $usuario->usubairro              = $request->input('usubairro');
        $usuario->usucidade              = $request->input('usucidade');
        $usuario->usuestado              = $request->input('usuestado');
        $usuario->usunumeroendereco      = $request->input('usunumeroendereco');
        $usuario->usucomplementoendereco = $request->input('usucomplementoendereco');
    
        // Atualizar a senha se a nova senha estiver presente
        if ($request->filled('newpassword')) {
            $usuario->password = Hash::make($request->input('newpassword'));
        }
    
        $usuario->save();
    
        return redirect()->route('lojista')->with('sucessoHome', 'Usuário alterado com sucesso.');
    }
    

}
