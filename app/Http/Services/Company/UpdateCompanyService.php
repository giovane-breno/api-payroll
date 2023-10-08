<?php

namespace App\Http\Services\Company;

use App\Enums\MessageEnum;
use App\Models\Company;
use Exception;

class UpdateCompanyService
{
    protected $name;
    protected $corporate_name;
    protected $CNPJ;
    protected $town_registration;
    protected $state_registration;

    public function __construct(
        $name,
        $corporate_name,
        $CNPJ,
        $town_registration,
        $state_registration,
    ) {
        $this->name = $name;
        $this->corporate_name = $corporate_name;
        $this->CNPJ = $CNPJ;
        $this->town_registration = $town_registration;
        $this->state_registration = $state_registration;
    }

    public function updateCompany(int $id)
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::fill == função utilizada para atualizar os dados
            $query = Company::findOrFail($id);
            $query::fill([
                'name' => $this->name,
                'corporate_name' => $this->corporate_name,
                'CNPJ' => $this->CNPJ,
                'town_registration' => $this->town_registration,
                'state_registration' => $this->state_registration,
            ]);

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_UPDATED);
        }
    }
}