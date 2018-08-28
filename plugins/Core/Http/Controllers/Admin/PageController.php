<?php

namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Requests\Admin\Page\PageDestroyRequest;
use Zix\Core\Http\Requests\Admin\Page\PageShowRequest;
use Zix\Core\Http\Requests\Admin\Page\PageStoreRequest;
use Zix\Core\Http\Requests\Admin\Page\PageUpdateRequest;
use Zix\Core\Http\Resources\Admin\PageResource;
use Zix\Core\Models\Page;

/**
 * Class PageController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Page
 */
class PageController
{
    /**
     * @var Page
     */
    private $model;


    /**
     * PageController constructor.
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param PageShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PageShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param PageShowRequest $request
     * @param Page $page
     * @return PageResource
     */
    public function show(PageShowRequest $request, Page $page)
    {
        return new PageResource($page);
    }

    /**
     * @param PageStoreRequest $request
     * @return PageResource
     */
    public function store(PageStoreRequest $request)
    {
        return new PageResource($this->model->create($request->input()));
    }

    /**
     * @param PageUpdateRequest $request
     * @param Page $page
     * @return PageResource
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $page->update($request->input());
        return new PageResource($page);
    }

    /**
     * @param PageDestroyRequest $request
     * @param Page $page
     * @return PageResource
     * @throws \Exception
     */
    public function destroy(PageDestroyRequest $request, Page $page)
    {
        $page->delete();
        return new PageResource($page);
    }

}