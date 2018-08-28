<?php

namespace Zix\Core\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class PermissionResource
 * @package Zix\Core\Http\Resources\Admin
 */
class PermissionResource extends Resource
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
            'name' => $this->name
        ];
    }
}
