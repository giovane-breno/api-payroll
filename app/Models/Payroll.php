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

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id')->select([
            'id',
            'full_name',
            'email',
        ]);
    }

    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id')->select([
            'id',
            'name',
            'corporate_name',
            'CNPJ'
        ]);
    }

    public function scopeFilter($query)
    {
        if (request('username')) {
            $query->where('username', 'like', '%' . request('username') . '%');
        }

        return $query;
    }
}