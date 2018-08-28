<?php

namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Requests\Admin\Testimonial\TestimonialDestroyRequest;
use Zix\Core\Http\Requests\Admin\Testimonial\TestimonialShowRequest;
use Zix\Core\Http\Requests\Admin\Testimonial\TestimonialStoreRequest;
use Zix\Core\Http\Requests\Admin\Testimonial\TestimonialUpdateRequest;
use Zix\Core\Http\Resources\Admin\TestimonialResource;
use Zix\Core\Models\Testimonial;

/**
 * Class TestimonialController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Testimonial
 */
class TestimonialController
{
    /**
     * @var Testimonial
     */
    private $model;


    /**
     * TestimonialController constructor.
     * @param Testimonial $model
     */
    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }

    /**
     * @param TestimonialShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TestimonialShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param TestimonialShowRequest $request
     * @param Testimonial $testimonial
     * @return TestimonialResource
     */
    public function show(TestimonialShowRequest $request, Testimonial $testimonial)
    {
        return new TestimonialResource($testimonial);
    }

    /**
     * @param TestimonialStoreRequest $request
     * @return TestimonialResource
     */
    public function store(TestimonialStoreRequest $request)
    {
        return new TestimonialResource($this->model->create($request->input()));
    }

    /**
     * @param TestimonialUpdateRequest $request
     * @param Testimonial $testimonial
     * @return TestimonialResource
     */
    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->input());
        return new TestimonialResource($testimonial);
    }

    /**
     * @param TestimonialDestroyRequest $request
     * @param Testimonial $testimonial
     * @return TestimonialResource
     * @throws \Exception
     */
    public function destroy(TestimonialDestroyRequest $request, Testimonial $testimonial)
    {
        $testimonial->delete();
        return new TestimonialResource($testimonial);
    }

}