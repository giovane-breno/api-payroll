<?php

namespace App\Http\Resources\Payroll;

use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->Company,
            'company_address' => $this->CompanyAddress,
            'worker' => [
                'id' => $this->User->id,
                'name' => $this->full_name,
                'role' => $this->role,
                'division' => $this->division
            ],

            'data' => [
                'base_salary' => number_format($this->base_salary, 2),
                'bonus' => number_format($this->bonus, 2),
                'benefits' => number_format($this->benefits, 2),
                'vacation' => number_format($this->vacation, 2),
            ],

            'total' => [
                'discounts' => number_format($this->discounts, 2),
                'gross_salary' => number_format($this->gross_salary, 2),
                'net_salary' => number_format($this->net_salary, 2),
            ],

            'competence' => $this->created_at->format('F/Y'),
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),
        ];
    }
}