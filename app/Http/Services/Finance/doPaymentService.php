<?php

namespace App\Http\Services\Finance;

use App\Enums\MessageEnum;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use stdClass;

class DoPaymentService
{
    /**
     * Realiza o pagamento de todos os funcionários
     * Utiliza as funções: getUserData(), checkPayrollPeriod(), createPayroll().
     * MessageEnum é utilizado para reutilizar frases feitas.
     * $success e $fail é utilizado para contabilizar os usuarios que tiveram seus holerites.
     * 
     * @return array contendo uma mensagem e os dados gerados.
     */
    public function doPayment()
    {
        $message = MessageEnum::SUCCESS_CREATED;
        $success = 0;
        $fail = 0;

        try {
            $userList = User::get();
            foreach ($userList as $user) {
                $userData = ($this->getUserData($user->id));
                if ($this->checkPayrollPeriod($user->id)) {
                    ($this->createPayroll($userData));
                    $success++;
                } else {
                    $fail++;
                }
            }
            return ['message' => $message, 'data' => ['generated' => $success, 'not_generated' => $fail]];

        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }

    public function doIndividualPayment(int $id)
    {
        $message = MessageEnum::SUCCESS_CREATED;

        try {

            $userData = ($this->getUserData($id));
            if ($this->checkPayrollPeriod($id)) {
                ($this->createPayroll($userData));
            } else {
                throw new Exception('Usuário já possui o holerite do mês atual.');
            }

            return ['message' => $message];

        } catch (Exception $th) {
            throw new Exception(MessageEnum::FAILURE_CREATED);
        }
    }

    private function createPayroll($userData)
    {
        Payroll::create([
            'company_id' => $userData->company_id,
            'user_id' => $userData->user_id,
            'full_name' => $userData->full_name,
            'role' => $userData->role,
            'division' => $userData->division,
            'base_salary' => $userData->base_salary,
            'bonus' => $userData->bonus,
            'benefits' => $userData->benefits,
            'vacation' => $userData->vacation,
            'discounts' => $userData->discounts,
            'gross_salary' => $userData->gross_salary,
            'net_salary' => $userData->net_salary,
        ]);
    }

    protected function getUserData($id)
    {

        $query = User::with('Role', 'Division', 'Company', 'Gratifications', 'Incidents', 'Vacations:user_id,bonus', 'Benefits')->findOrFail($id);

        $discount = ($this->sumIncidents($query->incidents));
        $base_salary = $query->role->base_salary + $query->division->bonus;
        $bonus = ($this->sumGratifications($query->gratifications));
        $vacation = ($this->getUserVacation($query->vacations));
        $benefits = ($this->sumBenefits($query->benefits));
        $gross_salary = $query->role->base_salary + $query->division->bonus + $bonus + $vacation + $benefits;
        $net_salary = round($gross_salary - $discount, 2);

        $userData = new stdClass;
        $userData->company_id = $query->company->id;
        $userData->user_id = $query->id;
        $userData->full_name = $query->full_name;
        $userData->role = $query->role->name;
        $userData->division = $query->division->name;
        $userData->base_salary = $base_salary;
        $userData->bonus = $bonus;
        $userData->benefits = $benefits;
        $userData->vacation = $vacation;
        $userData->discounts = $discount;
        $userData->gross_salary = $gross_salary;
        $userData->net_salary = $net_salary;

        return $userData;
    }

    private function getUserVacation($vacation)
    {
        if (!empty($vacation[0])) {
            return round(floatval($vacation[0]->bonus), 2);
        } else {
            return 0;
        }
    }

    private function sumIncidents($incidents_array)
    {
        $total = 0;
        $incidents_array = $incidents_array->pluck('discounted_amount');
        foreach ($incidents_array as $incident) {
            $total += floatval($incident);
        }

        return round($total, 2);
    }

    private function sumGratifications($gratifications_array)
    {
        $total = 0;
        $gratifications_array = $gratifications_array->pluck('bonus');
        foreach ($gratifications_array as $gratification) {
            $total += floatval($gratification);
        }

        return round($total, 2);

    }

    private function sumBenefits($benefits_array)
    {
        $total = 0;

        foreach ($benefits_array as $benefit) {
            $bonus = optional($benefit->benefitsType)->bonus;
            if (!is_null($bonus)) {
                $total += floatval($bonus);
            }
        }

        return $total;
    }

    private function checkPayrollPeriod($id)
    {
        try {
            $query = Payroll::orderBy('created_at', 'desc')->whereUserId($id)->firstOrFail()->created_at;
            if (!(Carbon::now()->isSameMonth($query))) {
                return True;
            } else {
                return False;
            }
        } catch (ModelNotFoundException $e) {
            return True;
        }
    }
}