<?php

namespace Zix\Core\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class GalleryResource extends Resource
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
            'type' => $this->type,
            'title' => $this->title,
            'images' => ImageResource::collection($this->getMedia('images'))
        ];
    }
}
