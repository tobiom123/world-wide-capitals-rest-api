<?php

namespace App\Services\ExternalApi;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CountriesNowService
{
    private const BASE_URL = 'https://countriesnow.space/api/v0.1/';
    private string $cacheKey = 'countriesnowcachekey';

    public function fetchCountriesData()
    {
        //Checking if already stored in cache, if so retrieving from cache
        if (Cache::has($this->cacheKey)) return Cache::get($this->cacheKey);

        $endpoint = 'countries/capital';
        $response = Http::get(self::BASE_URL.$endpoint);

        if(!$response->successful()) return null;

        $jsonResponse = $response->json();
        //Storing in cache
        Cache::put($this->cacheKey, $jsonResponse, now()->addMinutes(10));

        return $jsonResponse;
    }
}
