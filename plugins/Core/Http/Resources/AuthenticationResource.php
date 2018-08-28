<?php

namespace Zix\Core\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class AuthenticationResource
 * @package Zix\Core\Http\Resources
 */
class AuthenticationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'token' => $this->createToken($request->header('User-Agent'))->accessToken,
            'user' => new UserResource($this)
        );
    }
}