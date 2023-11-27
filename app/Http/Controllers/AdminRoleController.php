<?php

namespace App\Http\Controllers;

use App\Http\Services\AdminRole\CreateAdminRoleService;
use App\Http\Services\AdminRole\DeleteAdminRoleService;
use App\Http\Services\AdminRole\ListActiveAdminRolesService;
use App\Http\Services\AdminRole\FindAdminRoleService;
use App\Http\Services\AdminRole\UpdateAdminRoleService;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    // Retorna uma lista das funções administrativas ativas
    public function ListActiveAdminRole()
    {
        try {
            $service = new ListActiveAdminRolesService();
            $response = $service->listAdminRoles();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra e retorna os detalhes de uma função administrativa específica com base no ID.
     */
    public function findAdminRole(int $id)
    {
        try {
            $service = new FindAdminRoleService();
            $response = $service->findAdminRole($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cria uma nova função administrativa no sistema.
     */
    public function createAdminRole(Request $request)
    {
        // Valida os dados recebidos na requisição
        $request->validate([
            'name' => 'string',
            'abilities' => 'required'
        ]);

        try {
            $service = new CreateAdminRoleService(
                $request->name,
                $request->abilities,
            );

            $response = $service->createAdminRole();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza os detalhes de uma função administrativa existente com base no ID.
     */
    public function updateAdminRole(Request $request, int $id)
    {
        // Valida os dados recebidos na requisição
        $request->validate([
            'name' => 'required',
            'abilities' => 'required'
        ]);

        try {
            $service = new UpdateAdminRoleService(
                $request->name,
                $request->abilities
            );

            $response = $service->updateAdminRole($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove uma função administrativa com base no ID.
     */
    public function deleteAdminRole(int $id)
    {
        try {
            $service = new DeleteAdminRoleService();
            $response = $service->deleteAdminRole($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
