<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'email',
        'full_name',
        'gender',
        'born_at',
        'marital_status',
        'education_level',
        'cpf',
        'ctps',
        'pis',
        'company_id',
        'role_id',
        'division_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id')->select([
            'id',
            'name',
            'corporate_name',
            'CNPJ',
            'town_registration',
            'state_registration',
        ]);
    }

    public function CompanyAddress()
    {
        return $this->hasOne(CompanyAddress::class, 'company_id');
    }

    public function Address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }

    public function Phone()
    {
        return $this->hasOne(Phone::class, 'user_id')->select([
            'id',
            'phone_number'
        ]);
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id')->select([
            'id',
            'name',
            'base_salary'
        ]);
    }

    public function Vacations()
    {
        return $this->hasMany(Vacation::class, 'user_id')->where('end_date', '>', Carbon::today())->select([
            'id',
            'bonus',
            DB::raw("FORMAT(start_date, 'dd/MM/yyyy') as start_date"), // Format start_date in SQL Server
            DB::raw("FORMAT(end_date, 'dd/MM/yyyy') as end_date") // Format end_date in SQL Server
        ]);

    }

    public function Benefits()
    {
        return $this->hasMany(Benefit::class, 'user_id')->with('benefitsType');
    }

    public function Incidents()
    {
        return $this->hasMany(Incident::class, 'user_id')->where('end_date', '>', Carbon::today())->select([
            'id',
            'incident_reason',
            'discounted_amount',
            DB::raw("FORMAT(start_date, 'dd/MM/yyyy') as start_date"), // Format start_date in SQL Server
            DB::raw("FORMAT(end_date, 'dd/MM/yyyy') as end_date") // Format end_date in SQL Server
        ]);
    }

    public function Gratifications()
    {
        return $this->hasMany(Gratification::class, 'user_id')->where('end_date', '>', Carbon::today())->select([
            'id',
            'gratification_reason',
            'bonus',
            DB::raw("FORMAT(start_date, 'dd/MM/yyyy') as start_date"), // Format start_date in SQL Server
            DB::raw("FORMAT(end_date, 'dd/MM/yyyy') as end_date") // Format end_date in SQL Server
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

    public function isAdmin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('full_name', 'like', '%' . request('search') . '%');
        }

        if (request('company')) {
            $query->where('company_id', '=', request('company'));
        }

        return $query;
    }

    // GRATIFICATIONS
    // VACATION
    // INCIDENT

}