<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'benefit_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id')->select([
            'id',
            'full_name',
        ]);
    }

    public function Benefit()
    {
        return $this->belongsTo(BenefitType::class, 'benefit_id')->select([
            'id',
            'name',
            'bonus',
        ]);
    }

    public function benefitsType()
    {
        return $this->belongsTo(BenefitType::class, 'benefit_id');
    }

    public function scopeFilter($query)
    {
        if (request('username')) {
            $query->where('username', 'like', '%' . request('username') . '%');
        }

        if (request('company')) {
            $query->where('company_id', '=', request('company'));
        }

        return $query;
    }

}