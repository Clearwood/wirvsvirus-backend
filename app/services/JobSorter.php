<?php

namespace App\services;

use App\Models\Job;
use App\Models\Supplier;

/**
 * Class JobSorter
 *
 * @package App\services
 */
class JobSorter
{

    private const SEARCH_RADIUS_KILOMETERS = 50;
    private const LONGITUDE_TO_KILOMETERS = 71.44;
    private const LATITUDE_TO_KILOMETERS = 111.13;

    /**
     * @param Job[] $jobs
     * @param float $lat
     * @param float $lon
     *
     * @param       $radius
     *
     * @return array
     */
    public function presortJobs($jobs, float $lat, float $lon, $radius)
    {
        $closeJobs = [];
        foreach ($jobs as $job) {
            if (sqrt(pow(($lat - $job->consumer->user->latitude) * self::LATITUDE_TO_KILOMETERS,
                        2) + pow(($lon - $job->consumer->user->longitude) * self::LONGITUDE_TO_KILOMETERS,
                        2)) < $radius) {
                $closeJobs[] = $job;
            }
        }
        return $closeJobs;
    }

    public function sortJobs(?Supplier $supplier, $jobs, float $lat, float $lon)
    {
        $closeJobs = $this->presortJobs($jobs, $lat, $lon, self::SEARCH_RADIUS_KILOMETERS);
        if (empty($closeJobs)) {
            return [];
        }
        $mode = $supplier ? ($supplier->hasCar ? 'driving' : ($supplier->hasBike ? 'bicycling' : 'walking')) : 'driving';
        $dist = new DistanceService();
        $res = $dist->dist("$lat,$lon", implode('|', array_map(function (Job $job) {
            return $job->consumer->user->getAddress();
        }, $closeJobs)), $mode);
        foreach ($closeJobs as $key => $job) {
            $job->distance = [
                'mode' => $mode,
                'distance' => $res['json']['rows'][0]['elements'][$key]['distance']['value'],
                'duration' => $res['json']['rows'][0]['elements'][$key]['duration']['value'],
            ];
        }
        usort($closeJobs, function (Job $a, Job $b) {
            return $a->distance['distance'] <=> $b->distance['distance'];
        });
        return $closeJobs;
    }

}