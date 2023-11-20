<?php

namespace App\Http\Services\User;

use App\Enums\MessageEnum;
use App\Models\Address;
use App\Models\Phone;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserService
{
    protected $name;
    protected $email;
    protected $gender;
    protected $born_at;
    protected $marital_status;
    protected $education_level;
    protected $cpf;
    protected $ctps;
    protected $pis;
    protected $company_id;
    protected $role_id;
    protected $division_id;

    protected $address;
    protected $phones;

    public function __construct(
        $name,
        $email,
        $gender,
        $born_at,
        $marital_status,
        $education_level,
        $cpf,
        $ctps,
        $pis,
        $company_id,
        $role_id,
        $division_id,
        $address,
        $phones,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->born_at = $born_at;
        $this->marital_status = $marital_status;
        $this->education_level = $education_level;
        $this->cpf = $cpf;
        $this->ctps = $ctps;
        $this->pis = $pis;
        $this->company_id = $company_id;
        $this->role_id = $role_id;
        $this->division_id = $division_id;

        $this->address = $address;
        $this->phones = $phones;
    }

    public function createUser()
    {
        // MessageEnum == MENSAGENS PREDEFINIDAS PARA EVITAR REPETIÇÃO DE CÓDIGO
        $message = MessageEnum::SUCCESS_CREATED;

        try {
            // User::create == função utilizada para salvar os dados no banco de dados.
            $query = User::create([
                'username' => ($this->generateUsername($this->cpf)),
                'password' => ($this->generatePassword($this->cpf)),
                'full_name' => $this->name,
                'email' => $this->email,
                'gender' => $this->gender,
                'born_at' => $this->born_at,
                'marital_status' => $this->marital_status,
                'education_level' => $this->education_level,
                'cpf' => $this->cpf,
                'ctps' => $this->ctps,
                'pis' => $this->pis,
                'company_id' => $this->company_id,
                'role_id' => $this->role_id,
                'division_id' => $this->division_id,
            ]);

            if ($query) {
                if (($this->saveAddress($query->id, $this->address)) && (($this->savePhone($query->id, $this->phones)))) {
                    return ['message' => $message];
                } else {
                    $query->delete();
                }
            }

            return ['id' => $query->id, 'message' => $message];
        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED . $th);
        }
    }

    public function saveAddress($id, $address)
    {
        try {
            $query = Address::create([
                'user_id' => $id,
                'CEP' => $address['cep'],
                'street' => $address['street'],
                'district' => $address['district'],
                'city' => $address['city'],
                'house_number' => $address['house_number'],
                'complement' => $address['complement'] ?? null,
                'references' => $address['references'] ?? null,
            ]);

            if ($query)
                return True;

        } catch (Exception $e) {
            throw new Exception(MessageEnum::FAILURE_CREATED.$e);
        }

        return False;
    }

    public function savePhone($id, $phones)
    {
        try {
            $query = Phone::create([
                'user_id' => $id,
                'phone_number' => $phones['phone_number']
            ]);

            if ($query)
                return True;

        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED.$th);
        }

        return False;
    }

    private function generateUsername($cpf)
    {
        $username = str_replace(['.', '-'], '', $cpf);
        return $username;
    }

    private function generatePassword($cpf)
    {
        $password_converted = substr(str_replace('.', '', $cpf), 0, 4);
        $password_encrypted = Hash::make($password_converted);
        return $password_encrypted;
    }

}