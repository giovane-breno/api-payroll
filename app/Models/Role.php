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
        if (request('username')) {
            $query->where('username', 'like', '%' . request('username') . '%');
        }

        if (request('company')) {
            $query->whereHas('user', function ($q) {
                $q->where('company_id', '=', request('company'));
            });
        }

        return $query;
    }
}
