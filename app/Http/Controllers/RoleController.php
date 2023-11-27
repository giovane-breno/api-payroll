<?php

namespace App\Http\Controllers;

use App\Http\Services\Role\ListActiveRolesService;
use App\Http\Services\Role\CreateRoleService;
use App\Http\Services\Role\DeleteRoleService;
use App\Http\Services\Role\FindRoleService;
use App\Http\Services\Role\UpdateRoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Lista os cargos ativos.
     */
    public function listActiveRoles()
    {
        try {
            // Instância do serviço para listar os cargos ativos
            $service = new ListActiveRolesService();
            
            // Chamada do método para listar os cargos
            $response = $service->listRoles();
            
            // Retorno da resposta em JSON com status e dados
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta JSON com status e mensagem de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra um cargo específico com base no ID.
     */
    public function findRole(int $id)
    {
        try {
            // Instância do serviço para encontrar um cargo específico
            $service = new FindRoleService();
            
            // Chamada do método para encontrar um cargo com o ID especificado
            $response = $service->findRole($id);
            
            // Retorno da resposta em JSON com status e dados
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta JSON com status e mensagem de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cria um novo cargo no sistema.
     */
    public function createRole(Request $request)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'name' => 'string',
            'base_salary' => 'numeric'
        ]);

        try {
            // Instância do serviço para criar um novo cargo
            $service = new CreateRoleService(
                $request->name,
                $request->base_salary
            );

            // Chamada do método para criar um novo cargo
            $response = $service->createRole();
            
            // Retorno da resposta em JSON com status e mensagem
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta JSON com status e mensagem de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um cargo no sistema.
     */
    public function updateRole(Request $request, int $id)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'name' => 'string',
            'base_salary' => 'numeric'
        ]);

        try {
            // Instância do serviço para atualizar um cargo
            $service = new UpdateRoleService(
                $request->name,
                $request->base_salary
            );

            // Chamada do método para atualizar um cargo com o ID especificado
            $response = $service->updateRole($id);
            
            // Retorno da resposta em JSON com status e dados atualizados
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta JSON com status e mensagem de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um cargo do sistema.
     */
    public function deleteRole(int $id)
    {
        try {
            // Instância do serviço para deletar um cargo
            $service = new DeleteRoleService();
            
            // Chamada do método para deletar um cargo com o ID especificado
            $response = $service->deleteRole($id);

            // Retorno da resposta em JSON com status e mensagem de sucesso
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            // Em caso de erro, retorna uma resposta JSON com status e mensagem de erro
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
