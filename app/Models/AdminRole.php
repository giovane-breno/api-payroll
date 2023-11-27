<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abilities'
    ];

    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        return $query;
    }

}
