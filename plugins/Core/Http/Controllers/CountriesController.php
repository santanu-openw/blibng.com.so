<?php


namespace Zix\Core\Http\Controllers;


use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

/**
 * Class CountriesController
 * @package Zix\Core\Http\Controllers
 */
class CountriesController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function allCountries(Request $request)
    {
        $countries = new Countries();

        return $countries->all()->pluck('name.common');
    }

    /**
     * @param Request $request
     * @param $country
     * @return mixed
     */
    public function getCountryStates(Request $request, $country)
    {
        $countries = new Countries();

        $country = $countries->where('name.common', $country)->first();

        return $country->hydrate('cities')->cities->pluck('name');
    }
}