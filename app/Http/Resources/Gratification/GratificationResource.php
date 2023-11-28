<?php

namespace App\Http\Resources\Gratification;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class GratificationResource extends JsonResource
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
            'user' => $this->User,
            'gratification_reason' => $this->gratification_reason,
            'bonus' => number_format($this->bonus, 2, '.', ''),
            'start_date' => Carbon::parse($this->start_date)->format('d/m/Y'),
            'end_date' => Carbon::parse($this->end_date)->format('d/m/Y'),
            'created_at' => $this->created_at->format('d/m/y H:i'),
            'updated_at' => $this->updated_at->format('d/m/y H:i'),
        ];
    }
}