<?php

namespace App\Http\Controllers;

use App\Http\Services\Division\DeleteDivisionService;
use App\Http\Services\Division\FindDivisionService;
use App\Http\Services\Division\UpdateDivisionService;
use App\Http\Services\Division\CreateDivisionService;
use App\Http\Services\Division\ListActiveDivisionsService;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Lista as divisões ativas.
     */
    public function listActiveDivisions()
    {
        try {
            $service = new ListActiveDivisionsService();
            $response = $service->listDivisions();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra uma divisão específica com base no ID.
     */
    public function findDivision(int $id)
    {
        try {
            $service = new FindDivisionService();
            $response = $service->findDivision($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cria uma nova divisão no sistema.
     */
    public function createDivision(Request $request)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            // Instância do serviço de criação de divisão
            $service = new CreateDivisionService(
                $request->name,
                $request->bonus
            );

            // Chama o método para criar uma divisão
            $response = $service->createDivision();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma divisão no sistema.
     */
    public function updateDivision(Request $request, int $id)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            // Instância do serviço de atualização de divisão
            $service = new UpdateDivisionService(
                $request->name,
                $request->bonus
            );

            // Chama o método para atualizar uma divisão
            $response = $service->updateDivision($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma divisão do sistema.
     */
    public function deleteDivision(int $id)
    {
        try {
            // Instância do serviço de exclusão de divisão
            $service = new DeleteDivisionService();

            // Chama o método para excluir uma divisão
            $response = $service->deleteDivision($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
