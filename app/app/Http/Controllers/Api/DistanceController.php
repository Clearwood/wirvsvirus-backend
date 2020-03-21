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
        $value = $request->input('lala');
        $dist = new DistanceService();
        return new JsonResponse([]);
    }

}