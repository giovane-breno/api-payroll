<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'base_salary'
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('company')) {
            $query->whereHas('user', function ($q) {
                $q->where('company_id', '=', request('company'));
            });
        }

        return $query;
    }
}
