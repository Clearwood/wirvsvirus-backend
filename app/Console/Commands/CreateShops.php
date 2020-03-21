<?php

namespace App\Console\Commands;

use App\Models\Shop;
use Illuminate\Console\Command;

class CreateShops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-shops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the shop information from a json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $shops = json_decode(file_get_contents(__DIR__ . '/../../../storage/shops.json'), true);
        $this->output->progressStart(sizeof($shops['elements']) * 2);
        $counter = 0;
        $wayPoints = [];
        foreach ($shops['elements'] as $s) {
            $this->output->progressAdvance();
            if ($s['type'] === 'node' && !array_key_exists('tags', $s)) {
                $wayPoints[$s['id']] = $s;
            }

        }
        foreach ($shops['elements'] as $s) {
            $this->output->progressAdvance();
            if ($s['type'] === 'way') {
                if (!array_key_exists('tags', $s)
                    || !array_key_exists('name', $s['tags'])) {
                    continue;
                }
                $counter++;
                $shop = Shop::create([
                    'latitude' => $wayPoints[$s['nodes'][0]]['lat'],
                    'longitude' => $wayPoints[$s['nodes'][0]]['lon'],
                    'streetName' => $s['tags']['addr:street'] ?? null,
                    'houseNumber' => $s['tags']['addr:housenumber'] ?? null,
                    'city' => $s['tags']['addr:city'] ?? 'Berlin',
                    'postCode' => $s['tags']['addr:postcode'] ?? null,
                    'extraAddressInformation' => '',
                    'brand' => $s['tags']['brand'] ?? null,
                    'name' => $s['tags']['name'] ?? null,
                    'type' => '',
                ]);
                $shop->save();
            } else if ($s['type'] === 'node') {
                if (!array_key_exists('tags', $s)
                    || !array_key_exists('name', $s['tags'])) {
                    continue;
                }
                $counter++;
                $shop = Shop::create([
                    'latitude' => $s['lat'],
                    'longitude' => $s['lon'],
                    'streetName' => $s['tags']['addr:street'] ?? null,
                    'houseNumber' => $s['tags']['addr:housenumber'] ?? null,
                    'city' => $s['tags']['addr:city'] ?? 'Berlin',
                    'postCode' => $s['tags']['addr:postcode'] ?? null,
                    'extraAddressInformation' => '',
                    'brand' => $s['tags']['brand'] ?? null,
                    'name' => $s['tags']['name'] ?? null,
                    'type' => '',
                ]);
                $shop->save();
            }
        }
        $this->output->progressFinish();
        $this->output->success("Finished.\nNew entries: $counter");
    }
}
