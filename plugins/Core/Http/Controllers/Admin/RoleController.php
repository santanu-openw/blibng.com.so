<?php namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Resources\Admin\RoleResource;
use Zix\Core\Models;
//use Zix\Core\Events\Role as RoleEvents;
use Zix\Core\Http\Requests\Admin\Role as RoleRequests;
use Zix\Core\Http\Requests\Admin\Permission as PermissionRequests;

/**
 * Class RoleController
 * @property Models\Role model
 * @package Zix\Core\Http\Controllers
 * @resource Admin Roles
 */
class RoleController
{
    /**
     * TestController constructor.
     * @param Models\Role $model
     */
    public function __construct(Models\Role $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @param RoleRequests\RoleShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RoleRequests\RoleShowRequest $request)
    {
        return datatables()->eloquent($this->model->with('permissions'))->toJson();
    }

    /**
     * Show
     * @param RoleRequests\RoleShowRequest $request
     * @param Models\Role $role
     * @return RoleResource
     */
    public function show(RoleRequests\RoleShowRequest $request, Models\Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Store
     *
     * @param  RoleRequests\RoleStoreRequest $request
     * @return RoleResource
     */
    public function store(RoleRequests\RoleStoreRequest $request)
    {
        $model = $this->model->create($request->input());

        return new RoleResource($model);
    }


    /**
     * Update
     *
     * @param  Models\Role $role
     * @param  RoleRequests\RoleUpdateRequest $request
     * @return RoleResource
     */
    public function update(RoleRequests\RoleUpdateRequest $request, Models\Role $role)
    {
        $role->update($request->input());

        return new RoleResource($role);
    }


    /**
     * Destroy
     * @param RoleRequests\RoleDestroyRequest $request
     * @param Models\Role $role
     * @return RoleResource
     * @throws \Exception
     */
    public function destroy(RoleRequests\RoleDestroyRequest $request, Models\Role $role)
    {
        $role->delete();

        return new RoleResource($role);
    }

    /**
     * Update Permissions
     * @param PermissionRequests\PermissionUpdateRequest $request
     * @param Models\Role $role
     * @return RoleResource
     */
    public function updatePermissions(PermissionRequests\PermissionUpdateRequest $request, Models\Role $role)
    {
        return new RoleResource($role->syncPermissions($this->getRequestPermissionsKeys($request)));
    }

    /**
     * @param PermissionRequests\PermissionUpdateRequest $request
     * @return static
     */
    private function getRequestPermissionsKeys(PermissionRequests\PermissionUpdateRequest $request)
    {
        return collect($request->input())->filter(function ($permission) {
            return $permission;
        })->keys();
    }
}