<?php

namespace Zix\CarWash\Http\Controllers\Admin;

use Zix\CarWash\Http\Requests\Admin\Service\ServiceDestroyRequest;
use Zix\CarWash\Http\Requests\Admin\Service\ServiceShowRequest;
use Zix\CarWash\Http\Requests\Admin\Service\ServiceStoreRequest;
use Zix\CarWash\Http\Requests\Admin\Service\ServiceUpdateRequest;
use Zix\CarWash\Http\Resources\Admin\ServiceResource;
use Zix\CarWash\Models\Service;

/**
 * Class ServiceController
 * @package Zix\CarWash\Http\Controllers\Admin
 * @resource Admin Service
 */
class ServiceController
{
    /**
     * ServiceController constructor.
     * @param Service $model
     */
    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    /**
     * @param ServiceShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ServiceShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param ServiceShowRequest $request
     * @param Service $service
     * @return ServiceResource
     */
    public function show(ServiceShowRequest $request, Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * @param ServiceStoreRequest $request
     * @return ServiceResource
     */
    public function store(ServiceStoreRequest $request)
    {
        return new ServiceResource($this->model->create($request->input()));
    }

    /**
     * @param ServiceUpdateRequest $request
     * @param Service $service
     * @return ServiceResource
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->input());
        return new ServiceResource($service);
    }

    /**
     * @param ServiceDestroyRequest $request
     * @param Service $service
     * @return ServiceResource
     * @throws \Exception
     */
    public function destroy(ServiceDestroyRequest $request, Service $service)
    {
        $service->delete();
        return new ServiceResource($service);
    }

}