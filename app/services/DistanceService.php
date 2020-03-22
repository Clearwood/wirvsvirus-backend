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

    public function dist(string $start, string $end, string $mode) {
        $client = new Client();
        $res = $client-> get('https://maps.googleapis.com/maps/api/distancematrix/json', ['query' => ['origins' =>  $start, 'destinations' => $end, 'mode' => $mode, 'key' => env('GMAPS_KEY')]]);
        $result['json'] = json_decode($res->getBody(), true);
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

    public function reverseGeo(float $lat,float $lng) {
        $client = new Client();
        $latlng = $lat . "," . $lng;
        $res = $client-> get('https://maps.googleapis.com/maps/api/geocode/json', ['query' => ['latlng' =>  $latlng, 'key' => env('GMAPS_KEY')]]);
        $result['json'] = json_decode($res->getBody(), true);
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

    public function address2Geo(string $address) {
        $client = new Client();
        $res = $client-> get('https://maps.googleapis.com/maps/api/geocode/json', ['query' => ['address' =>  $address, 'key' => env('GMAPS_KEY')]]);
        $result['json'] = json_decode($res->getBody(), true);
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

}
