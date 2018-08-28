<?php namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Requests\Admin\Permission as PermissionRequests;
use Zix\Core\Http\Resources\Admin\PermissionResource;
use Zix\Core\Models;


/**
 * Class PermissionController
 * @property Models\Permission model
 * @package Zix\Core\Http\Controllers
 * @resource Admin Permissions
 */
class PermissionController
{
    /**
     * PermissionController constructor.
     * @param Models\Permission $model
     */
    public function __construct(Models\Permission $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @param PermissionRequests\PermissionShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PermissionRequests\PermissionShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * Show
     * @param PermissionRequests\PermissionShowRequest $request
     * @param Models\Permission $permission
     * @return PermissionResource
     */
    public function show(PermissionRequests\PermissionShowRequest $request, Models\Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Store
     *
     * @param  PermissionRequests\PermissionStoreRequest $request
     * @return PermissionResource
     */
    public function store(PermissionRequests\PermissionStoreRequest $request)
    {
        $model = $this->model->create($request->input());

        return new PermissionResource($model);
    }


    /**
     * Update
     *
     * @param  Models\Permission  $permission
     * @param  PermissionRequests\PermissionUpdateRequest $request
     * @return PermissionResource
     */
    public function update(PermissionRequests\PermissionUpdateRequest $request, Models\Permission $permission)
    {
        $permission->update($request->input());

        return new PermissionResource($permission);
    }


    /**
     * Destroy
     * @param PermissionRequests\PermissionDestroyRequest $request
     * @param Models\Permission $permission
     * @return PermissionResource
     * @throws \Exception
     */
    public function destroy(PermissionRequests\PermissionDestroyRequest $request, Models\Permission $permission)
    {
        $permission->delete();

        return new PermissionResource($permission);
    }
}