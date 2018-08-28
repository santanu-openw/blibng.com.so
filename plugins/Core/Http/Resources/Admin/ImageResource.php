<?php

namespace Zix\Core\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class ImageResource extends Resource
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
            'url' => url($this->getUrl()),
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'file_name' => $this->file_name,
            'title' => $this->getCustomProperty('title'),
        ];
    }
}
