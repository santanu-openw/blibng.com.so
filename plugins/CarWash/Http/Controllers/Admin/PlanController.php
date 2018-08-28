<?php

namespace Zix\CarWash\Http\Controllers\Admin;

use Zix\CarWash\Http\Requests\Admin\Plan\PlanDestroyRequest;
use Zix\CarWash\Http\Requests\Admin\Plan\PlanShowRequest;
use Zix\CarWash\Http\Requests\Admin\Plan\PlanStoreRequest;
use Zix\CarWash\Http\Requests\Admin\Plan\PlanUpdateRequest;
use Zix\CarWash\Http\Resources\Admin\PlanResource;
use Zix\CarWash\Models\Plan;

/**
 * Class PlanController
 * @package Zix\CarWash\Http\Controllers\Admin
 * @resource Admin Package Plan
 */
class PlanController
{

    /**
     * PackageController constructor.
     * @param Plan $model
     */
    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    /**
     * @param PlanShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PlanShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param PlanShowRequest $request
     * @param Plan $plan
     * @return PlanResource
     */
    public function show(PlanShowRequest $request, Plan $plan)
    {
        return new PlanResource($plan);
    }

    /**
     * @param PlanStoreRequest $request
     * @return PlanResource
     */
    public function store(PlanStoreRequest $request)
    {
        return new PlanResource($this->model->create($request->input()));
    }

    /**
     * @param PlanUpdateRequest $request
     * @param Plan $plan
     * @return PlanResource
     */
    public function update(PlanUpdateRequest $request, Plan $plan)
    {
        $plan->update($request->input());
        return new PlanResource($plan);
    }

    /**
     * @param PlanDestroyRequest $request
     * @param Plan $plan
     * @return PlanResource
     * @throws \Exception
     */
    public function destroy(PlanDestroyRequest $request, Plan $plan)
    {
        $plan->delete();
        return new PlanResource($plan);
    }
}