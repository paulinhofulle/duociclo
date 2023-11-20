<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Models\Loja;
use Illuminate\Validation\Rules\Unique;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LojaController extends Controller {

    public function consultaLoja(Request $request) {
        $search = $request->input('search');
        $query = Loja::query();
    
        if ($search) {
            $query->where('lojnome', 'like', "%$search%");
        }
        $lojas = $query->paginate(9);
        $totalLojas = $lojas->total();
        return view('site/administrador/loja/consulta', compact('lojas', 'totalLojas', 'search'));
    }

    public function incluirLoja(Request $request){
        /*$bValido = $request->validate([
            'lojnome'               => ['required'],
            'lojcnpj'               => ['required', 'min:14', 'unique:tbloja'],
            'lojtelefone'           => ['required'],
            'lojcep'                => ['required', 'min:8'],
            'lojrua'                => ['required'],
            'lojbairro'             => ['required'],
            'lojcidade'             => ['required'],
            'lojestado'             => ['required'],
            'lojnumeroendereco'     => ['required', 'numeric'],
            'lojcomplemento'        => ['nullable']
        ],[
            'lojnome.required'           => 'O campo Nome é obrigatório!',
            'lojcnpj.required'           => 'O campo CNPJ é obrigatório!',
            'lojcnpj.min'                => 'O campo CNPJ deve ter 14 números!',
            'lojcnpj.unique'             => 'Este CNPJ já está sendo utilizado!',
            'lojtelefone.required'       => 'O campo Telefone é obrigatório!',
            'lojnumeroendereco.required' => 'O campo N° Endereço é obrigatório!',
            'lojnumeroendereco.numeric'  => 'O campo N° Endereço deve ser numérico!',
            'lojrua.required'            => 'O campo Rua é obrigatório!',
            'lojbairro.required'         => 'O campo Bairro é obrigatório!',
            'lojcidade.required'         => 'O campo Cidade é obrigatório!',
            'lojestado.required'         => 'O campo Estado é obrigatório!',
            'lojcep.required'            => 'O campo CEP é obrigatório!',
            'lojcep.min'                 => 'O campo CEP deve ter 8 números!'
        ]);

        if($bValido){*/
            $aLojaData = [
                'lojnome'                => $request->input('lojnome'),
                'lojcnpj'                => $request->input('lojcnpj'),
                'lojnumeroendereco'      => $request->input('lojnumeroendereco'),
                'lojtelefone'            => $request->input('lojtelefone'),
                'lojemail'               => $request->input('lojemail'),
                'lojcep'                 => $request->input('lojcep'),
                'lojrua'                 => $request->input('lojrua'),
                'lojbairro'              => $request->input('lojbairro'),
                'lojcidade'              => $request->input('lojcidade'),
                'lojestado'              => $request->input('lojestado'),
                'lojcomplementoendereco' => $request->input('lojcomplementoendereco')
            ];
            var_dump($aLojaData);
            Loja::create($aLojaData);
            return redirect()->route('consultaLoja')->with('sucesso', 'Loja incluída com sucesso.');
        //}
    }

    public function alterarLoja(Request $request, $id){
        $bValido = $request->validate([
            'lojnome'               => ['required'],
            'lojcnpj'               => ['required', 'min:14', (new Unique('tbloja'))->ignore($id, 'lojcnpj')],
            'lojtelefone'           => ['required'],
            'lojcep'                => ['required', 'min:8'],
            'lojnumeroendereco'     => ['required', 'numeric'],
            'lojcomplemento'        => ['nullable']
        ],[
            'lojnome.required'           => 'O campo Nome é obrigatório!',
            'lojcnpj.required'           => 'O campo CNPJ é obrigatório!',
            'lojcnpj.min'                => 'O campo CNPJ deve ter 14 números!',
            'lojcnpj.unique'             => 'Este CNPJ já está sendo utilizado!',
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
            
            $loja->lojnome = $request->input('lojnome');
            $loja->lojcnpj = $request->input('lojcnpj');
            $loja->lojnumeroendereco = $request->input('lojnumeroendereco');
            $loja->lojtelefone = $request->input('lojtelefone');
            $loja->lojemail = $request->input('lojemail');
            $loja->lojcep = $request->input('lojcep');
            $loja->lojcomplementoendereco = $request->input('lojcomplementoendereco');
    
            $loja->save();
    
            return redirect()->route('consultaLoja')->with('sucesso', 'Loja alterada com sucesso.');
        }
    }

    public function excluirLoja(Request $request) {
        $id = $request->input('id');
        $loja = Loja::find($id);
    
        if (!$loja) {
            return redirect()->route('consultaLoja')->with('erro', 'Loja não encontrada.');
        }
        $loja->delete();
    
        return redirect()->route('consultaLoja')->with('sucesso', 'Loja excluída com sucesso!');
    }

}
