<?php

namespace App\Http\Controllers;

use App\Http\Services\Company\CreateCompanyService;
use App\Http\Services\Company\DeleteCompanyService;
use App\Http\Services\Company\FindCompanyService;
use App\Http\Services\Company\ListActiveCompaniesService;
use App\Http\Services\Company\UpdateCompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveCompanies()
    {
        try {
            $service = new ListActiveCompaniesService();
            $response = $service->listCompanies();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra uma Divisão em especifico.
     */
    public function findCompany(int $id)
    {
        try {
            $service = new FindCompanyService();
            $response = $service->findCompany($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cadastra os novas Divisões no sistema.
     */
    public function createCompany(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'corporate_name' => 'required',
                'CNPJ' => 'unique:companies|required',
                'town_registration' => 'required',
                'state_registration' => 'required',

                'address.cep' => 'required',
                'address.street' => 'required',
                'address.district' => 'required',
                'address.house_number' => 'required',
            ],
            [
                'name.required' => 'O campo Nome Fantasia é obrigatório!',
                'corporate_name.required' => 'O campo Razão Social é obrigatório!',
                'town_registration.required' => 'O campo Inscrição Municipal é obrigatório!',
                'state_registration.required' => 'O campo Inscrição Estadual é obrigatório!',
                'CNPJ.required' => 'O campo CNPJ é obrigatório!',
                'CNPJ.unique' => 'O CNPJ informado já está cadastrado.',

                'address.cep.required' => 'O campo CEP é obrigatório!',
                'address.street.required' => 'O campo Rua é obrigatório!',
                'address.district.required' => 'O campo Bairro é obrigatório!',
                'address.house_number.required' => 'O campo Número da Casa é obrigatório!',

            ]
        );

        try {
            $service = new CreateCompanyService(
                $request->name,
                $request->corporate_name,
                $request->CNPJ,
                $request->town_registration,
                $request->state_registration,

                $request->address
            );

            $response = $service->createCompany();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza uma Divisão no sistema.
     */
    public function updateCompany(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string|required',
            'corporate_name' => 'string|required',
            'CNPJ' => ['unique:Company', 'string', 'required'],
            'town_registration' => 'string|required',
            'state_registration' => 'string|required',
            'address' => 'string|required',
        ]);

        try {
            $service = new UpdateCompanyService(
                $request->name,
                $request->corporate_name,
                $request->CNPJ,
                $request->town_registration,
                $request->state_registration,
                $request->address
            );

            $response = $service->updateCompany($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta uma Divisão do sistema.
     */
    public function deleteCompany(int $id)
    {
        try {
            $service = new DeleteCompanyService();
            $response = $service->deleteCompany($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}