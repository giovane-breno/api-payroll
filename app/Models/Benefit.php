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

}