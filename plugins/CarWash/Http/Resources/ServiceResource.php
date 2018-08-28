<?php

namespace Zix\CarWash\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ServiceResource extends Resource
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
            'price' => $this->price,
            'service_time' => $this->service_time,
        ];
    }
}
