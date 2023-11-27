<?php

namespace App\Http\Controllers;

use App\Http\Services\User\CreateUserService;
use App\Http\Services\User\DeleteUserService;
use App\Http\Services\User\FindUserService;
use App\Http\Services\User\ListActiveUsersService;
use App\Http\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Lista todos os usuários ativos.
     */
    public function listActiveUsers()
    {
        // Tenta obter a lista de usuários ativos e retorna em formato JSON
        try {
            $service = new ListActiveUsersService();
            $response = $service->listUsers();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra um usuário específico.
     */
    public function findUser(int $id)
    {
        // Tenta encontrar um usuário pelo ID e retorna em formato JSON
        try {
            $service = new FindUserService();
            $response = $service->findUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cria novos usuários no sistema.
     */
    public function createUser(Request $request)
    {
        // Valida os dados recebidos via request e cria um novo usuário
        // Captura exceções caso ocorram erros e retorna a resposta em formato JSON
    }

    /**
     * Atualiza um usuário no sistema.
     */
    public function updateUser(Request $request, int $id)
    {
        // Valida os dados recebidos via request e atualiza um usuário existente
        // Captura exceções caso ocorram erros e retorna a resposta em formato JSON
    }

    /**
     * Deleta um usuário do sistema.
     */
    public function deleteUser(int $id)
    {
        // Tenta deletar um usuário pelo ID especificado e retorna a resposta em formato JSON
        try {
            $service = new DeleteUserService();
            $response = $service->deleteUser($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
