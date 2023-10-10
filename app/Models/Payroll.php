<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'user_id',
        'full_name',
        'role',
        'base_salary',
        'bonus',
        'benefits',
        'vacation',
        'discounts',
        'gross_salary',
        'net_salary'
    ];
}
