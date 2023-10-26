<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Aluguel;
use App\Models\User;

class ClienteController extends Controller {
    
    public function menu(){
        $aluguel = Aluguel::with('tbparcela')
        ->where('alusituacao', 1) // Aluguel em andamento
        ->where('usucodigo', Auth::user()->usuariocodigo) // Cliente logado
        ->first();
        return view('site/cliente/painel', compact('aluguel'));
    }

    public function meuPerfil(){
        $usuario = User::find(Auth::user()->id);
        return view('site/cliente/meuPerfil', compact('usuario'));
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
    
            return redirect()->route('cliente')->with('sucessoHome', 'Usuário alterado com sucesso.');
        }
        else{
            return redirect()->route('cliente')->with('erro', 'Usuário não encontrado.');
        }
    }

}
