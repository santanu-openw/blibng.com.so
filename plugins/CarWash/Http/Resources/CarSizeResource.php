<?php

namespace Zix\CarWash\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CarSizeResource extends Resource
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
            'm_price' => $this->m_price,
            'm_operation' => $this->m_operation,

            'img_blank' => $this->img_blank,
            'img_active' => $this->img_active,

        ];
    }
}
