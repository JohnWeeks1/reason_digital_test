<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    /**
     * Weather Service
     *
     * @var $weatherService
     */
    private $weatherService;

    /**
     * Weather controller constructor
     *
     * @return null
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * Get the weather data by place name. EG: London | Paris | Madrid
     *
     * @var string $location
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $location = '')
    {
        // Check if string length is greater than 1
        if (strlen($location) < 2) {
            return response()->json(['error' => 'Location length needs to be greater than 1'], 400);
        }
        // Find weather information by location
        $res = $this->weatherService->getWeatherByLocation($location);

        // Check if bool is true or false
        if ($res['success'] === false) {
            return response()->json(['error' => 'Something went wrong? Please enter a location. EG: London | Paris | Madrid'], 400);
        }

        return response($res['response'][0], 200);

    }
}
