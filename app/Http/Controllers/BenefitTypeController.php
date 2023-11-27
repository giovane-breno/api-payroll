<?php

namespace App\Http\Controllers;

use App\Http\Services\BenefitType\CreateBenefitTypeService;
use App\Http\Services\BenefitType\DeleteBenefitTypeService;
use App\Http\Services\BenefitType\FindBenefitTypeService;
use App\Http\Services\BenefitType\ListActiveBenefitTypesService;
use App\Http\Services\BenefitType\UpdateBenefitTypeService;
use Illuminate\Http\Request;

class BenefitTypeController extends Controller
{
    /**
     * Lista todos os tipos de benefícios ativos.
     */
    public function ListActiveBenefitTypes()
    {
        try {
            $service = new ListActiveBenefitTypesService();
            $response = $service->listBenefitTypes();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um tipo de benefício específico.
     */
    public function findBenefit(int $id)
    {
        try {
            $service = new FindBenefitTypeService();
            $response = $service->findBenefitType($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Cadastra novos tipos de benefícios no sistema.
     */
    public function createBenefit(Request $request)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para criar um novo tipo de benefício
            $service = new CreateBenefitTypeService(
                $request->name,
                $request->bonus,
            );

            // Chama o serviço para criar o tipo de benefício
            $response = $service->createBenefitType();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um tipo de benefício no sistema.
     */
    public function updateBenefit(Request $request, int $id)
    {
        // Validação dos dados recebidos via request
        $request->validate([
            'name' => 'string',
            'bonus' => 'numeric'
        ]);

        try {
            // Cria uma instância do serviço para atualizar um tipo de benefício
            $service = new UpdateBenefitTypeService(
                $request->name,
                $request->bonus
            );

            // Chama o serviço para atualizar o tipo de benefício
            $response = $service->updateBenefitType($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um tipo de benefício do sistema.
     */
    public function deleteBenefit(int $id)
    {
        try {
            // Cria uma instância do serviço para deletar um tipo de benefício
            $service = new DeleteBenefitTypeService();
            $response = $service->deleteBenefitType($id);

            // Chama o serviço para deletar o tipo de benefício
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

