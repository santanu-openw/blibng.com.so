<?php

namespace Zix\CarWash\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class PlanResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}