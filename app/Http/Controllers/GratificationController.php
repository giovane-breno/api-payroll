<?php

namespace App\Http\Controllers;

use App\Http\Services\Gratification\CreateGratificationService;
use App\Http\Services\Gratification\DeleteGratificationService;
use App\Http\Services\Gratification\FindGratificationService;
use App\Http\Services\Gratification\ListActiveGratificationsService;
use App\Http\Services\Gratification\UpdateGratificationService;
use Illuminate\Http\Request;

class GratificationController extends Controller
{
    /**
     * Lista todas as gratificações ativas.
     */
    public function listActiveGratifications()
    {
        try {
            $service = new ListActiveGratificationsService();
            $response = $service->listGratifications();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
    
    /**
     * Mostra uma gratificação específica.
     */
    public function findGratification(int $id)
    {
        try {
            $service = new FindGratificationService();
            $response = $service->findGratification($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra novas gratificações no sistema.
     */
    public function createGratification(Request $request)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'gratification_reason' => 'string',
            'bonus' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            // Cria uma instância do serviço para criar uma nova gratificação
            $service = new CreateGratificationService(
                $request->user_id,
                $request->gratification_reason,
                $request->bonus,
                $request->start_date,
                $request->end_date
            );

            // Chama o serviço para criar a gratificação
            $response = $service->createGratification();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma gratificação no sistema.
     */
    public function updateGratification(Request $request, int $id)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'gratification_reason' => 'string',
            'bonus' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            // Cria uma instância do serviço para atualizar uma gratificação
            $service = new UpdateGratificationService(
                $request->user_id,
                $request->gratification_reason,
                $request->bonus,
                $request->start_date,
                $request->end_date
            );

            // Chama o serviço para atualizar a gratificação
            $response = $service->updateGratification($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma gratificação do sistema.
     */
    public function deleteGratification(int $id)
    {
        try {
            // Cria uma instância do serviço para deletar uma gratificação
            $service = new DeleteGratificationService();
            $response = $service->deleteGratification($id);

            // Chama o serviço para deletar a gratificação
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
