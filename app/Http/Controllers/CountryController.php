<?php

namespace App\Http\Controllers;

use App\Services\ExternalApi\CountriesNowService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private CountriesNowService $countriesNowService;

    public function __construct(CountriesNowService $countriesNowService)
    {
        $this->countriesNowService = $countriesNowService;
    }

    public function index(Request $request)
    {
        return $this->countriesNowService->fetchCountriesData();
    }

    public function getCountriesArray(Request $request): array
    {
        $response = json_decode(json_encode($this->index()));
        $countries = [];
        foreach($response->data as $countryData) {
            if(isset($countryData->name)) $countries[] = $countryData->name;
        }

        return $countries;
    }

    public function getRandomCountry(Request $request): ?string
    {
        $countries = $this->getCountriesArray();
        if(!empty($countries)) return collect($countries)->random();

        throw new \RuntimeException('No countries available.');
    }
}
