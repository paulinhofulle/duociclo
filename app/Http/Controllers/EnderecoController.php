<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EnderecoController extends Controller
{
    public function obterEnderecoPorCep(Request $request)
    {
        $cep = $request->input('cep');

        // URL da API ViaCEP para consulta de endereço por CEP
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        try {
            // Criação do cliente Guzzle e realização da requisição ao ViaCEP
            $client = new Client();
            $response = $client->get($url);

            // Verifica se a resposta foi bem-sucedida
            if ($response->getStatusCode() === 200) {
                // Converte a resposta JSON para um array associativo
                $jsonResponse = json_decode($response->getBody(), true);

                // Verifica se a resposta JSON é válida
                if (json_last_error() === JSON_ERROR_NONE) {
                    // Aqui, você pode processar as informações do endereço conforme necessário
                    return response()->json(['data' => $jsonResponse]);
                } else {
                    // Lida com a resposta JSON inválida
                    return response()->json(['error' => 'Resposta do ViaCEP não é um JSON válido']);
                }
            } else {
                // Lida com a resposta não bem-sucedida
                return response()->json(['error' => 'Erro na chamada à API do ViaCEP'], 500);
            }
        } catch (\Exception $e) {
            // Lidar com exceções, por exemplo:
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}
