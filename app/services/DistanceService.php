<?php

namespace App\services;
use GuzzleHttp\Client;

/**
 * Class DistanceService
 *
 * @package App\services
 */
class DistanceService
{

    public function __construct()
    {

    }

    public function dist(string $start, string $end) {
        $client = new Client();
        $api_key = 'AIzaSyAZpc1apVCngmenB0ChSp-U2l5sFD4LhtI';
        $res = $client-> get('https://maps.googleapis.com/maps/api/distancematrix/json', ['origins' =>  $start, 'destinations' => $end, 'key' => $api_key]);
        $result['json'] = json_decode($res->getBody());
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

}
