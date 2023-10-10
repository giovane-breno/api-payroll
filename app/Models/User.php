<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'name',
        'cpf',
        'ctps',
        'pis',
        'company_id',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeFilter($query)
    {
        if (request('username')) {
            $query->where('username', 'like', '%' . request('username') . '%');
        }

        return $query;
    }

    public function Company()
    {
        return $this->belongsTo(Company::class, 'id')->select([
            'id',
            'name',
            'corporate_name',
            'CNPJ',
            'town_registration',
            'state_registration',
        ]);
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'id')->select([
            'id',
            'name',
            'base_salary'
        ]);
    }

    public function Vacations()
    {
        return $this->hasMany(Vacation::class, 'user_id')->where('end_date', '>', Carbon::today());
        ;
    }

    public function Benefits()
    {
        return $this->hasMany(Benefit::class, 'user_id')->with('benefitsType');
    }

    public function Incidents()
    {
        return $this->hasMany(Incident::class, 'user_id');
    }

    public function Gratifications()
    {
        return $this->hasMany(Gratification::class, 'user_id')->where('end_date', '>', Carbon::today());
    }

    public function Division()
    {
        return $this->belongsTo(Division::class, 'id')->select([
            'id',
            'name',
            'bonus'
        ]);
    }

    // GRATIFICATIONS
    // VACATION
    // INCIDENT

}