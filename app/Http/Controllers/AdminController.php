<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\CreateAdminService;
use App\Http\Services\Admin\DemoteAdminService;
use App\Http\Services\Admin\FindAdminService;
use App\Http\Services\Admin\ListActiveAdminsService;
use App\Http\Services\Admin\PromoteAdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Método para listar todos os administradores ativos
    public function listAdmins()
    {
        try {
            $service = new ListActiveAdminsService();
            $response = $service->listAdmins();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um administrador específico.
     */
    public function findAdmin(int $id)
    {
        try {
            $service = new FindAdminService();
            $response = $service->findAdmin($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra novos administradores no sistema.
     */
    public function createAdmin(Request $request)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'admin_role_id' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para criar um novo administrador
            $service = new CreateAdminService(
                $request->user_id,
                $request->admin_role_id,
            );

            // Chama o serviço para criar o administrador
            $response = $service->createAdmin();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Promove um administrador existente.
     */
    public function promoteAdmin(Request $request, int $id)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'admin_role_id' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para promover um administrador
            $service = new PromoteAdminService(
                $request->user_id,
                $request->admin_role_id,
            );

            // Chama o serviço para promover o administrador
            $response = $service->promoteAdmin($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove a função de administrador de um usuário.
     */
    public function demoteAdmin(int $id)
    {
        try {
            // Cria uma instância do serviço para rebaixar um administrador
            $service = new DemoteAdminService();
            $response = $service->demoteAdmin($id);

            // Chama o serviço para rebaixar o administrador
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}


