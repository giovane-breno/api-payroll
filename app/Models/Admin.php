<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_role_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id')->select([
            'id',
            'full_name',
            'username',
            'email'
        ]);
    }

    public function AdminRole()
    {
        return $this->belongsTo(AdminRole::class, 'admin_role_id')->select([
            'id',
            'name',
            'abilities'
        ]);
    }

    public function Division()
    {
        return $this->belongsTo(Division::class, 'division_id')->select([
            'id',
            'name',
            'bonus'
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
