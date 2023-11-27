<?php

namespace App\Http\Controllers;

use App\Http\Services\Finance\FindPayrollService;
use App\Http\Services\Finance\ListActivePayrollsService;
use App\Http\Services\Finance\DoPaymentService;
use App\Http\Services\Finance\DeletePayrollService;
use Exception;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Lista todos os pagamentos ativos.
     */
    public function ListActivePayrolls()
    {
        try {
            $service = new ListActivePayrollsService();
            $response = $service->listPayrolls();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Realiza o pagamento de todos os funcionários.
     */
    public function doPayment()
    {
        try {
            $service = new DoPaymentService();
            $response = $service->doPayment();

            return response()->json(['status' => 'success', 'message' => $response['message'], 'data' => $response['data']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Realiza o pagamento individual de um funcionário.
     */
    public function doIndividualPayment(int $id)
    {
        try {
            $service = new DoPaymentService();
            $response = $service->doIndividualPayment($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Encontra um pagamento específico.
     */
    public function findPayroll(int $id)
    {
        try {
            $service = new FindPayrollService();
            $response = $service->findPayroll($id);

            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um pagamento específico.
     */
    public function deletePayroll(int $id)
    {
        try {
            $service = new DeletePayrollService();
            $response = $service->deletePayroll($id);
            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

