<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bonus',
    ];

    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('company')) {
            $query->where('company_id', '=', request('company'));
        }

        return $query;
    }
}
