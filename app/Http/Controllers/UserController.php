<?php

namespace App\Http\Controllers;

use App\Http\Services\User\CreateUserService;
use App\Http\Services\User\DeleteUserService;
use App\Http\Services\User\FindUserService;
use App\Http\Services\User\ListActiveUsersService;
use App\Http\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveUsers()
    {
        try {
            $service = new ListActiveUsersService();
            $response = $service->listUsers();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Mostra um usuario em especifico.
     */
    public function findUser(int $id)
    {
        try {
            $service = new FindUserService();
            $response = $service->findUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

    /**
     * Cadastra os novos funcionarios no sistema.
     */
    public function createUser(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'gender' => 'required',
                'born_at' => 'required',
                'marital_status' => 'required',
                'education_level' => 'required',
                'cpf' => 'required|unique:users',
                'ctps' => 'required|unique:users',
                'pis' => 'required|unique:users',
                'company_id' => 'required',
                'role_id' => 'required',
                'division_id' => 'required',

                'address.cep' => 'required',
                'address.street' => 'required',
                'address.district' => 'required',
                'address.house_number' => 'required',

                'phones.phone_number' => 'required',
            ],
            [
                'name.required' => 'O campo Nome é obrigatório!',
                'email.required' => 'O campo Email é obrigatório!',
                'gender.required' => 'O campo Genero é obrigatório!',
                'born_at.required' => 'O campo Data de Nascimento é obrigatório!',
                'marital_status.required' => 'O campo Estado Civíl é obrigatório!',
                'education_level.required' => 'O campo Escolaridade é obrigatório!',
                'cpf.required' => 'O campo CPF é obrigatório!',
                'ctps.required' => 'O campo CTPS é obrigatório!',
                'pis.required' => 'O campo PIS é obrigatório!',
                'role_id.required' => 'O campo Função é obrigatório!',
                'division_id.required' => 'O campo Divisão é obrigatório!',

                'email.unique' => 'O Email informado já está cadastrado.',
                'cpf.unique' => 'O CPF informado já está cadastrado.',
                'ctps.unique' => 'O CTPS informado já está cadastrado.',
                'pis.unique' => 'O PIS informado já está cadastrado.',


                'address.cep.required' => 'O campo CEP é obrigatório!',
                'address.street.required' => 'O campo Rua é obrigatório!',
                'address.district.required' => 'O campo Bairro é obrigatório!',
                'address.house_number.required' => 'O campo Número da Casa é obrigatório!',

                'phones.phone_number.required' => 'O campo Telefone / Celular é obrigatório!',

            ]
        );




        try {
            $service = new CreateUserService(
                $request->name,
                $request->email,
                $request->gender,
                $request->born_at,
                $request->marital_status,
                $request->education_level,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id,
                $request->division_id,

                $request->address,
                $request->phones,
            );

            $response = $service->createUser();
            return response()->json(['status' => 'success', 'message' => $response['message']], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Atualiza um funcionario no sistema.
     */
    public function updateUser(Request $request, int $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                Rule::unique('users')->ignore($id),
                'gender' => 'required',
                'born_at' => 'required',
                'marital_status' => 'required',
                'education_level' => 'required',

                'cpf' => 'required',
                Rule::unique('users')->ignore($id),
                'ctps' => 'required',
                Rule::unique('users')->ignore($id),
                'pis' => 'required',
                Rule::unique('users')->ignore($id),
                'company_id' => 'required',
                'role_id' => 'required',
                'division_id' => 'required',

                'address.cep' => 'required',
                'address.street' => 'required',
                'address.district' => 'required',
                'address.house_number' => 'required',

                'phones.phone_number' => 'required',
            ],
            [
                'name.required' => 'O campo Nome é obrigatório!',
                'email.required' => 'O campo Email é obrigatório!',
                'gender.required' => 'O campo Genero é obrigatório!',
                'born_at.required' => 'O campo Data de Nascimento é obrigatório!',
                'marital_status.required' => 'O campo Estado Civíl é obrigatório!',
                'education_level.required' => 'O campo Escolaridade é obrigatório!',
                'cpf.required' => 'O campo CPF é obrigatório!',
                'ctps.required' => 'O campo CTPS é obrigatório!',
                'pis.required' => 'O campo PIS é obrigatório!',
                'role_id.required' => 'O campo Função é obrigatório!',
                'division_id.required' => 'O campo Divisão é obrigatório!',

                'email.unique' => 'O Email informado já está cadastrado.',
                'cpf.unique' => 'O CPF informado já está cadastrado.',
                'ctps.unique' => 'O CTPS informado já está cadastrado.',
                'pis.unique' => 'O PIS informado já está cadastrado.',


                'address.cep.required' => 'O campo CEP é obrigatório!',
                'address.street.required' => 'O campo Rua é obrigatório!',
                'address.district.required' => 'O campo Bairro é obrigatório!',
                'address.house_number.required' => 'O campo Número da Casa é obrigatório!',

                'phones.phone_number.required' => 'O campo Telefone / Celular é obrigatório!',

            ]
        );

        
        try {
            $service = new UpdateUserService(
                $request->name,
                $request->email,
                $request->gender,
                $request->born_at,
                $request->marital_status,
                $request->education_level,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id,
                $request->division_id,

                $request->address,
                $request->phones,
            );

            $response = $service->updateUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Deleta um funcionário do sistema.
     */
    public function deleteUser(int $id)
    {
        try {
            $service = new DeleteUserService();
            $response = $service->deleteUser($id);

            return response()->json(['status' => 'success', 'message' => $response['message']], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}

