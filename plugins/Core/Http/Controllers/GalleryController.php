<?php

namespace Zix\Core\Http\Controllers;


use Illuminate\Http\Request;
use Zix\Core\Http\Resources\Admin\GalleryResource;
use Zix\Core\Models\Gallery;

/**
 * Class GalleryController
 * @package Zix\Core\Http\Controllers
 */
class GalleryController
{
    /**
     * @param Request $request
     * @param $type
     * @return GalleryResource
     */
    public function index(Request $request, $type)
    {
        if (!$gallery = Gallery::where('type', $type)->first()) {
            $gallery = Gallery::first();
        }
        return new GalleryResource($gallery);
    }
}