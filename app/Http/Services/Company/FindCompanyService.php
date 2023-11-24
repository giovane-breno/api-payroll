<?php

namespace App\Http\Services\Company;

use App\Enums\MessageEnum;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\User\UserResource;
use App\Models\Company;
use Exception;

class FindCompanyService
{
    public function findCompany(int $id)
    {
        try {
            $query = Company::findOrFail($id);
            return new CompanyResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}