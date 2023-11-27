<?php

namespace App\Http\Controllers;

use App\Http\Services\Benefit\CreateBenefitService;
use App\Http\Services\Benefit\DeleteBenefitService;
use App\Http\Services\Benefit\FindBenefitService;
use App\Http\Services\Benefit\ListActiveBenefitsService;
use App\Http\Services\Benefit\UpdateBenefitService;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    // Método para listar todos os benefícios ativos
    public function ListActiveBenefit()
    {
        try {
            $service = new ListActiveBenefitsService();
            $response = $service->listBenefit();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um benefício específico.
     */
    public function findBenefit(int $id)
    {
        try {
            $service = new FindBenefitService();
            $response = $service->findBenefit($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra novos benefícios no sistema.
     */
    public function createBenefit(Request $request)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'benefit_id' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para criar um novo benefício
            $service = new CreateBenefitService(
                $request->user_id,
                $request->benefit_id,
            );

            // Chama o serviço para criar o benefício
            $response = $service->createBenefit();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um benefício no sistema.
     */
    public function updateBenefit(Request $request, int $id)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'user_id' => 'numeric',
            'benefit_id' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para atualizar um benefício
            $service = new UpdateBenefitService(
                $request->user_id,
                $request->benefit_id
            );

            // Chama o serviço para atualizar o benefício
            $response = $service->updateBenefit($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um benefício do sistema.
     */
    public function deleteBenefit(int $id)
    {
        try {
            // Cria uma instância do serviço para deletar um benefício
            $service = new DeleteBenefitService();
            $response = $service->deleteBenefit($id);

            // Chama o serviço para deletar o benefício
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}


