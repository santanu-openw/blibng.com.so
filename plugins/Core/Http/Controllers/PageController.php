<?php

namespace Zix\Core\Http\Controllers;


use Illuminate\Http\Request;
use Zix\Core\Http\Resources\PageResource;
use Zix\Core\Models\Page;

class PageController
{
    public function show(Request $request, $page)
    {
        if($page = Page::where('slug', $page)->first()) {
            return new PageResource($page);
        }
    }
}