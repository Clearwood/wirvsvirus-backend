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

}
