<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller{

    public function login(){
        return view('site/login');
    }

    public function auth(Request $request){
        $credenciais = $request->validate([
            'email'   => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'O campo E-mail é obrigatório!',
            'password.required' => 'O campo Senha é obrigatório!'
        ]);
       //dd($credenciais);
        if (Auth::attempt($credenciais)) {
            // A autenticação foi bem-sucedida
            $request->session()->regenerate();
            
            // Acessando o usuário autenticado
            $usuario = Auth::user();

            //dd($usuario);
            //dd(Auth::user());
            // Verificando o tipo de usuário e redirecionando com base nele
            if ($usuario->usutipo == 1) {
                return redirect()->intended('/administrador');
            } elseif ($usuario->usutipo == 2) {
                // Redirecionar para a tela do lojista
                return redirect()->intended('/lojista');
            } elseif ($usuario->usutipo == 3) {
                // Redirecionar para a tela do cliente
                return redirect()->intended('/cliente');
            }
        } else {
            // A autenticação falhou, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('erro', 'Login Inválido!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function cadastrar(){
        return view('site/cadastrar');
    }

    public function registrar(Request $request){
        $bValido = $request->validate([
            'usunome'               => ['required'],
            'usucpf'                => ['required', 'min:11', 'unique:users'],
            'usudatanascimento'     => ['required', 'date'],
            'usutelefone'           => ['required'],
            'email'                 => ['required', 'email', 'unique:users'],
            'usucep'                => ['required', 'min:8'],
            'usurua'                => ['required'],
            'usubairro'             => ['required'],
            'usucidade'             => ['required'],
            'usuestado'             => ['required'],
            'usunumeroendereco'     => ['required', 'numeric'],
            'usucomplemento'        => ['nullable'],
            'password'              => ['confirmed'],
            'password_confirmation' => ['required', 'min:6']
        ],[
            'usunome.required'           => 'O campo Nome é obrigatório!',
            'usucpf.required'            => 'O campo CPF é obrigatório!',
            'usucpf.min'                 => 'O campo CPF deve ter 11 números!',
            'usucpf.unique'              => 'Este CPF já está sendo utilizado!',
            'usudatanascimento.required' => 'O campo Data de Nascimento é obrigatório!',
            'usutelefone.required'       => 'O campo Telefone é obrigatório!',
            'email.required'             => 'O campo E-mail é obrigatório!',
            'email.email'                => 'O campo deve ter o @, pois o mesmo é do tipo E-mail!',
            'email.unique'               => 'Este e-mail já está sendo utilizado!',
            'usucep.required'            => 'O campo CEP é obrigatório!',
            'usucep.min'                 => 'O campo CEP deve ter 8 números!',
            'usurua.required'            => 'O campo Rua é obrigatório!',
            'usubairro.required'         => 'O campo Bairro é obrigatório!',
            'usucidade.required'         => 'O campo Cidade é obrigatório!',
            'usuestado.required'         => 'O campo Estado é obrigatório!',
            'usunumeroendereco.required' => 'O campo N° Endereço é obrigatório!',
            'usunumeroendereco.numeric'  => 'Só deve ser informado números!',
            'password.required'          => 'O campo senha é obrigatório!',
            'password.min'               => 'O campo senha deve ter no mínimo 6 digítos!',
            'password.confirmed'         => 'A senha de confirmação deve ser igual ao campo Senha'
        ]);

        if($bValido){
            $userData = [
                'usunome' => $request->input('usunome'),
                'usucpf' => $request->input('usucpf'),
                'usudatanascimento' => $request->input('usudatanascimento'),
                'usutelefone' => $request->input('usutelefone'),
                'usutipo' => 3,
                'usucep' => $request->input('usucep'),
                'usurua' => $request->input('usurua'),
                'usubairro' => $request->input('usubairro'),
                'usucidade' => $request->input('usucidade'),
                'usuestado' => $request->input('usuestado'),
                'usunumeroendereco' => $request->input('usunumeroendereco'),
                'usucomplementoendereco' => $request->input('usucomplemento'),
                'password' => bcrypt($request->input('password')),
            ];
        
            if ($request->has('email')) {
                $userData['email'] = $request->input('email');
            }
        
            User::create($userData);
            return redirect()->route('login')->with('sucesso', 'Cadastro realizado com sucesso!');
        }
        
    }

}
