<?php

namespace Zix\CarWash\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderResource extends Resource
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
            'package_id' => $this->package_id,
            'package' => new PackageResource($this->package),
            'plan_id' => $this->plan_id,
            'plan' => new PlanResource($this->plan),
            'car_size_id' => $this->car_size_id,
            'status' => $this->status,
            'payment_reference' => $this->payment_reference,
            'bill_number' => $this->bill_number,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'car_size' => new CarSizeResource($this->carSize),
            'services' => $this->services ? ServiceResource::collection($this->services) : [],
            'appointments' => $this->appointments ? AppointmentResource::collection($this->appointments) : [],
        ];
    }
}
