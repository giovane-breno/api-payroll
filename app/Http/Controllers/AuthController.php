<?php

namespace App\Http\Controllers;

use App\Http\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Método para efetuar o login do usuário
    public function login(Request $request)
    {
        // Valida os campos obrigatórios na requisição
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            // Instancia o serviço de autenticação
            $service = new AuthService();
            
            // Chama o método de login do serviço de autenticação
            $response = $service->login($request->username, $request->password);

            // Retorna uma resposta em JSON com os detalhes do login
            return response()->json(['status' => 'success', 'message' => $response['message'], 'data' => $response['user']], 200);
        } catch (Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
