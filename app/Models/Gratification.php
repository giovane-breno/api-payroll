<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gratification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'gratification_reason',
        'bonus',
        'start_date',
        'end_date'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id')->select([
            'id',
            'full_name',
        ]);
    }

    public function scopeFilter($query)
    {
        if (request('user_id')) {
            $query->where('user_id', '=', request('user_id'));
        }

        return $query;
    }
}