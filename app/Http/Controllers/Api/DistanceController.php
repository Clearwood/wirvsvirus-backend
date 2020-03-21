<?php

namespace App\Http\Controllers\Api;

use App\services\DistanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class DistanceController
 *
 * @package App\Http\Controllers\Api
 */
class DistanceController
{

    public function dist(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $dist = new DistanceService();
        $response = $dist->dist($start,$end);
        return new JsonResponse($response['json'], $response['status'], $response['header']);
    }

    public function reverseGeo(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $dist = new DistanceService();
        $response = $dist->reverseGeo($lat,$lng);
        return new JsonResponse($response['json'], $response['status'], $response['header']);
    }

    public function Address2Geo(Request $request)
    {
        $address = $request->input('address');
        $dist = new DistanceService();
        $response = $dist->Address2Geo($address);
        return new JsonResponse($response['json'], $response['status'], $response['header']);
    }

}
