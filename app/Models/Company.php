<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'corporate_name',
        'CNPJ',
        'town_registration',
        'state_registration'
    ];

    public function Address()
    {
        return $this->hasOne(CompanyAddress::class, 'company_id');
    }
}
