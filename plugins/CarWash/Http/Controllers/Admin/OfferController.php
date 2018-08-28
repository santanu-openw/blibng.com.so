<?php

namespace Zix\CarWash\Http\Controllers\Admin;

use Zix\CarWash\Http\Requests\Admin\Offer\OfferDestroyRequest;
use Zix\CarWash\Http\Requests\Admin\Offer\OfferShowRequest;
use Zix\CarWash\Http\Requests\Admin\Offer\OfferStoreRequest;
use Zix\CarWash\Http\Requests\Admin\Offer\OfferUpdateRequest;
use Zix\CarWash\Http\Resources\Admin\OfferResource;
use Zix\CarWash\Models\Offer;

/**
 * Class OfferController
 * @package Zix\CarWash\Http\Controllers\Admin
 * @resource Admin Offer
 */
class OfferController
{
    /**
     * @var Offer
     */
    private $model;


    /**
     * OfferController constructor.
     * @param Offer $model
     */
    public function __construct(Offer $model)
    {
        $this->model = $model;
    }

    /**
     * @param OfferShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(OfferShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param OfferShowRequest $request
     * @param Offer $offer
     * @return OfferResource
     */
    public function show(OfferShowRequest $request, Offer $offer)
    {
        return new OfferResource($offer);
    }

    /**
     * @param OfferStoreRequest $request
     * @return OfferResource
     */
    public function store(OfferStoreRequest $request)
    {
        return new OfferResource($this->model->create($request->input()));
    }

    /**
     * @param OfferUpdateRequest $request
     * @param Offer $offer
     * @return OfferResource
     */
    public function update(OfferUpdateRequest $request, Offer $offer)
    {
        $offer->update($request->input());
        return new OfferResource($offer);
    }

    /**
     * @param OfferDestroyRequest $request
     * @param Offer $offer
     * @return OfferResource
     * @throws \Exception
     */
    public function destroy(OfferDestroyRequest $request, Offer $offer)
    {
        $offer->delete();
        return new OfferResource($offer);
    }
}