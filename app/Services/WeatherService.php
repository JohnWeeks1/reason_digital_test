<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * Get the weather data by place name.
     *
     * @var string $location
     *
     * @return Illuminate\Support\Facades\Http
     */
    public function getWeatherByLocation(string $location)
    {
        return Http::get(
            env('WEATHER_API_URL') .
            "/conditions/summary/"  . $location . ',' .
            "?client_id=" . env('WEATHER_API_ID') .
            "&client_secret=" . env('WEATHER_API_SECRET')
        );
    }
}
