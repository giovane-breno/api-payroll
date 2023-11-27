<?php

namespace App\Http\Controllers;

use App\Http\Services\Vacation\CreateVacationService;
use App\Http\Services\Vacation\DeleteVacationService;
use App\Http\Services\Vacation\FindVacationService;
use App\Http\Services\Vacation\ListActiveVacationsService;
use App\Http\Services\Vacation\UpdateVacationService;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    // Lista todas as férias ativas
    public function listActiveVacations()
    {
        try {
            $service = new ListActiveVacationsService();
            $response = $service->listVacations();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    // Encontra uma férias específica pelo ID
    public function findVacation(int $id)
    {
        try {
            $service = new FindVacationService();
            $response = $service->findVacation($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    // Cria uma nova entrada de férias
    public function createVacation(Request $request)
    {
        $request->validate([
            'user_id' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new CreateVacationService(
                $request->user_id,
                $request->start_date,
                $request->end_date
            );

            $response = $service->createVacation();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    // Atualiza informações de férias existentes
    public function updateVacation(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'numeric',
            'start_date' => 'date',
            'end_date' => 'date'
        ]);

        try {
            $service = new UpdateVacationService(
                $request->user_id,
                $request->start_date,
                $request->end_date
            );

            $response = $service->updateVacation($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    // Deleta uma entrada de férias pelo ID
    public function deleteVacation(int $id)
    {
        try {
            $service = new DeleteVacationService();
            $response = $service->deleteVacation($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}
