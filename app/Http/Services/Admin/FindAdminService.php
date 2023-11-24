<?php

namespace App\Http\Services\Admin;

use App\Enums\MessageEnum;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use Exception;

class FindAdminService
{

    public function findAdmin(int $id)
    {
        try {
            $query = Admin::findOrFail($id);
            return new AdminResource($query);
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_FIND);
        }
    }
}