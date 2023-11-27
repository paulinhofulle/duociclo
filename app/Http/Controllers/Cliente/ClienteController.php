<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Aluguel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller {
    
    public function menu(){
        $aluguel = Aluguel::with('tbparcela', 'tbveiculo', 'tbplano')
        ->where('alusituacao', 1) // Aluguel em andamento
        ->where('usucodigo', Auth::user()->id) // Cliente logado
        ->first();

        $situacoes = [
            1 => 'Em Andamento',
            2 => 'Finalizado'
        ];
        return view('site/cliente/painel', compact('aluguel', 'situacoes'));
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
    
            return redirect()->route('cliente')->with('sucessoHome', 'Usuário alterado com sucesso.');
    }

}
