<?php

namespace Zix\CarWash\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PackageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'period' => $this->period,
            'trial_period' => $this->trial_period,
            'm_price' => $this->m_price,
            'm_operation' => $this->m_operation,
            'number_of_washes_per_week' => $this->number_of_washes_per_week,
            'services' => ServiceResource::collection($this->services)
        ];
    }
}
