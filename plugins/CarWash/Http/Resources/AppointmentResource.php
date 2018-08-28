<?php

namespace Zix\CarWash\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AppointmentResource extends Resource
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
            'car_numbers' => $this->car_numbers,
            'client_notes' => $this->client_notes,
            'completed' => $this->completed,
            'day' => (int)$this->day,
            'hour' => $this->hour,
            'month' => (int)$this->month,
            'week' => (int)$this->week,
            'year' => (int)$this->year,
            'status' => $this->status,
        ];
    }
}
