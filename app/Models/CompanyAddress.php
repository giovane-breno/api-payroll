<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'CEP',
        'street',
        'district',
        'house_number',
        'complement',
        'references'
    ];
}
