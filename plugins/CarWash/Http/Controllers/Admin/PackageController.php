<?php

namespace Zix\CarWash\Http\Controllers\Admin;

use Zix\CarWash\Http\Requests\Admin\Package\PackageDestroyRequest;
use Zix\CarWash\Http\Requests\Admin\Package\PackageShowRequest;
use Zix\CarWash\Http\Requests\Admin\Package\PackageStoreRequest;
use Zix\CarWash\Http\Requests\Admin\Package\PackageUpdateRequest;
use Zix\CarWash\Http\Resources\Admin\PackageResource;
use Zix\CarWash\Models\Package;

/**
 * Class PackageController
 * @package Zix\CarWash\Http\Controllers\Admin
 * @resource Admin Package
 */
class PackageController
{

    /**
     * PackageController constructor.
     * @param Package $model
     */
    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * @param PackageShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PackageShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param PackageShowRequest $request
     * @param Package $package
     * @return PackageResource
     */
    public function show(PackageShowRequest $request, Package $package)
    {
        return new PackageResource($package);
    }

    /**
     * @param PackageStoreRequest $request
     * @return PackageResource
     */
    public function store(PackageStoreRequest $request)
    {
        return new PackageResource($this->model->create($request->input()));
    }

    /**
     * @param PackageUpdateRequest $request
     * @param Package $package
     * @return PackageResource
     */
    public function update(PackageUpdateRequest $request, Package $package)
    {
        $package->update($request->input());
        return new PackageResource($package);
    }

    /**
     * @param PackageDestroyRequest $request
     * @param Package $package
     * @return PackageResource
     * @throws \Exception
     */
    public function destroy(PackageDestroyRequest $request, Package $package)
    {
        $package->delete();
        return new PackageResource($package);
    }
}