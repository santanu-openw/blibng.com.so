<?php

namespace Zix\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Zix\Core\Http\Requests\Admin\Partner\PartnerDestroyRequest;
use Zix\Core\Http\Requests\Admin\Partner\PartnerShowRequest;
use Zix\Core\Http\Requests\Admin\Partner\PartnerStoreRequest;
use Zix\Core\Http\Requests\Admin\Partner\PartnerUpdateRequest;
use Zix\Core\Http\Resources\Admin\PartnerResource;
use Zix\Core\Models\Partner;

/**
 * Class PartnerController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Partners
 */
class PartnerController
{
    /**
     * @var Partner
     */
    private $model;


    /**
     * PartnerController constructor.
     * @param Partner $model
     */
    public function __construct(Partner $model)
    {
        $this->model = $model;
    }

    /**
     * @param PartnerShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PartnerShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param PartnerShowRequest $request
     * @param Partner $partner
     * @return PartnerResource
     */
    public function show(PartnerShowRequest $request, Partner $partner)
    {
        return new PartnerResource($partner);
    }

    /**
     * @param PartnerStoreRequest $request
     * @return PartnerResource
     */
    public function store(PartnerStoreRequest $request)
    {
        return new PartnerResource($this->model->create($request->input()));
    }

    /**
     * @param PartnerUpdateRequest $request
     * @param Partner $partner
     * @return PartnerResource
     */
    public function update(PartnerUpdateRequest $request, Partner $partner)
    {
        $partner->update($request->input());
        return new PartnerResource($partner);
    }

    public function updateLogo(Request $request, Partner $partner)
    {
        if ($request->hasFile('logo')) {
            $partner->getMedia('logos')->map(function ($image) {
                $image->delete();
            });

            $partner->logo = $partner->addMedia($request->file('logo'))->usingFileName('logo.png')->toMediaCollection('logos')->getUrl();
            $partner->save();
        }

        return new PartnerResource($partner);

    }

    /**
     * @param PartnerDestroyRequest $request
     * @param Partner $partner
     * @return PartnerResource
     * @throws \Exception
     */
    public function destroy(PartnerDestroyRequest $request, Partner $partner)
    {
        $partner->delete();
        return new PartnerResource($partner);
    }

}