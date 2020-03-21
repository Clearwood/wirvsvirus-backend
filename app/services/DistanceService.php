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
        $res = $client-> get('https://maps.googleapis.com/maps/api/distancematrix/json', ['query' => ['origins' =>  $start, 'destinations' => $end, 'key' => $api_key]]);
        $result['json'] = json_decode($res->getBody());
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

    public function reverseGeo(float $lat,float $lng) {
        $client = new Client();
        $api_key = 'AIzaSyAZpc1apVCngmenB0ChSp-U2l5sFD4LhtI';
        $latlng = $lat . "," . $lng;
        $res = $client-> get('https://maps.googleapis.com/maps/api/geocode/json', ['query' => ['latlng' =>  $latlng, 'key' => $api_key]]);
        $result['json'] = json_decode($res->getBody());
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

    public function Address2Geo(string address) {
        $client = new Client();
        $api_key = 'AIzaSyAZpc1apVCngmenB0ChSp-U2l5sFD4LhtI';
        $res = $client-> get('https://maps.googleapis.com/maps/api/geocode/json', ['query' => ['address' =>  $address, 'key' => $api_key]]);
        $result['json'] = json_decode($res->getBody());
        $result['status'] = $res->getStatusCode();
        $result['header'] = $res->getHeader('content-type');
        return $result;
    }

}
