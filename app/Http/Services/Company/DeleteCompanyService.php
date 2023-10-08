<?php

namespace App\Http\Services\Company;

use App\Enums\MessageEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Company;
use App\Models\User;
use Exception;

class DeleteCompanyService
{
    public function deleteCompany(int $id)
    {
        $message = MessageEnum::SUCCESS_DELETED;
        try {
            $query = Company::findOrFail($id);
            $query->delete();

            return ['message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_DELETED);
        }
    }
}