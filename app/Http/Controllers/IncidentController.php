<?php

namespace App\Http\Controllers;

use App\Http\Services\Incident\CreateIncidentService;
use App\Http\Services\Incident\DeleteIncidentService;
use App\Http\Services\Incident\FindIncidentService;
use App\Http\Services\Incident\ListActiveIncidentsService;
use App\Http\Services\Incident\UpdateIncidentService;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    /**
     * Lista os incidentes ativos.
     */
    public function listActiveIncidents()
    {
        try {
            $service = new ListActiveIncidentsService();
            $response = $service->listIncidents();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra um incidente específico com base no ID.
     */
    public function findIncident(int $id)
    {
        try {
            $service = new FindIncidentService();
            $response = $service->findIncident($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cria um novo incidente no sistema.
     */
    public function createIncident(Request $request)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'user_id' => 'numeric',
            'incident_reason' => 'string',
            'discounted_amount' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            // Instância do serviço de criação de incidente
            $service = new CreateIncidentService(
                $request->user_id,
                $request->incident_reason,
                $request->discounted_amount,
                $request->start_date,
                $request->end_date
            );

            // Chama o método para criar um incidente
            $response = $service->createIncident();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um incidente no sistema.
     */
    public function updateIncident(Request $request, int $id)
    {
        // Validação dos dados recebidos na requisição
        $request->validate([
            'user_id' => 'numeric',
            'incident_reason' => 'string',
            'discounted_amount' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            // Instância do serviço de atualização de incidente
            $service = new UpdateIncidentService(
                $request->user_id,
                $request->incident_reason,
                $request->discounted_amount,
                $request->start_date,
                $request->end_date
            );

            // Chama o método para atualizar um incidente
            $response = $service->updateIncident($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um incidente do sistema.
     */
    public function deleteIncident(int $id)
    {
        try {
            // Instância do serviço de exclusão de incidente
            $service = new DeleteIncidentService();

            // Chama o método para excluir um incidente
            $response = $service->deleteIncident($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
