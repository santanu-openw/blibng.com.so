<?php

namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Requests\Admin\Blog\BlogDestroyRequest;
use Zix\Core\Http\Requests\Admin\Blog\BlogShowRequest;
use Zix\Core\Http\Requests\Admin\Blog\BlogStoreRequest;
use Zix\Core\Http\Requests\Admin\Blog\BlogUpdateRequest;
use Zix\Core\Http\Resources\Admin\BlogResource;
use Zix\Core\Models\Blog;

/**
 * Class BlogController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Blog
 */
class BlogController
{
    /**
     * BlogController constructor.
     * @param Blog $model
     */
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }


    /**
     * @param BlogShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BlogShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param BlogShowRequest $request
     * @param Blog $blog
     * @return BlogResource
     */
    public function show(BlogShowRequest $request, Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * @param BlogStoreRequest $request
     * @return BlogResource
     */
    public function store(BlogStoreRequest $request)
    {
        return new BlogResource($this->model->create($request->input()));
    }

    /**
     * @param BlogUpdateRequest $request
     * @param Blog $blog
     * @return BlogResource
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $blog->update($request->input());
        return new BlogResource($blog);
    }

    /**
     * @param BlogDestroyRequest $request
     * @param Blog $blog
     * @return BlogResource
     * @throws \Exception
     */
    public function destroy(BlogDestroyRequest $request, Blog $blog)
    {
        $blog->delete();
        return new BlogResource($blog);
    }


}