<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'incident_reason',
        'discounted_amount',
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
            $query->where('user_id', '=', request('user_id') );
        }

        if (request('company')) {
            $query->where('company_id', '=', request('company'));
        }

        return $query;
    }
}
