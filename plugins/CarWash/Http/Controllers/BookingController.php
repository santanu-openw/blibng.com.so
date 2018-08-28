<?php

namespace Zix\CarWash\Http\Controllers;


use Zix\CarWash\Http\Resources\CarSizeResource;
use Zix\CarWash\Http\Resources\PackageResource;
use Zix\CarWash\Http\Resources\PlanResource;
use Zix\CarWash\Models\CarSize;
use Zix\CarWash\Models\Package;
use Zix\CarWash\Models\Plan;

/**
 * Class BookingController
 * @package Zix\CarWash\Http\Controllers
 */
class BookingController
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getPackages()
    {
        return PackageResource::collection(Package::orderBy('order')->with([
            'services' => function ($query) {
                return $query->orderBy('order');
            }
        ])->get());
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getPlans()
    {
        return PlanResource::collection(Plan::orderBy('order')->with([
            'packages' => function ($query) {
                return $query->orderBy('order');
            },
            'packages.services' => function ($query) {
                return $query->orderBy('order');
            }
        ])->get());
    }

    public function getCarSizes()
    {
        return CarSizeResource::collection(CarSize::orderBy('order')->get());
    }
}