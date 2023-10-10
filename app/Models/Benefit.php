<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    public function benefitsType()
{
    return $this->belongsTo(BenefitType::class, 'benefit_id');
}
}
