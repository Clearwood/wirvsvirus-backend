<?php

namespace App\Console\Commands;

use App\services\DistanceService;
use App\User;
use Carbon\Carbon;
use Faker\Generator;
use Faker\Guesser\Name;
use Faker\Provider\de_DE\Person;
use Faker\Provider\de_DE\PhoneNumber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Command
{
    private const ADDRESS2GEO_BERLIN = '{"json":{"results":[{"address_components":[{"long_name":"Berlin","short_name":"Berlin","types":["locality","political"]},{"long_name":"Berlin","short_name":"Berlin","types":["administrative_area_level_1","political"]},{"long_name":"Germany","short_name":"DE","types":["country","political"]}],"formatted_address":"Berlin, Germany","geometry":{"bounds":{"northeast":{"lat":52.6754542,"lng":13.7611175},"southwest":{"lat":52.338234,"lng":13.088346}},"location":{"lat":52.52000659999999,"lng":13.404954},"location_type":"APPROXIMATE","viewport":{"northeast":{"lat":52.6754542,"lng":13.7611175},"southwest":{"lat":52.338234,"lng":13.088346}}},"place_id":"ChIJAVkDPzdOqEcRcDteW0YgIQQ","types":["locality","political"]}],"status":"OK"},"status":200,"header":["application\/json; charset=UTF-8"]}';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--city=Berlin} {--N|number=1}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create users';

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
        $ds = new DistanceService();
        $osm = json_decode(file_get_contents(__DIR__ . '/../../../storage/osm_streets_berlin.json'), true);
        for ($i = 0; $i < $this->option('number'); $i++) {
            $user = new User();
            if ($this->option('city') === 'Berlin') {
    //            $resp = json_decode(self::ADDRESS2GEO_BERLIN, true);
                $successful = false;
                while (!$successful) {
                    $street = $osm['elements'][mt_rand(0, sizeof($osm['elements']))];
                    if (array_key_exists('name', $street['tags']) && array_key_exists('postal_code', $street['tags'])) {
                        $successful = true;
                    }
                }
                $user->streetName = $street['tags']['name'];
                $user->postCode = $street['tags']['postal_code'];
                $user->houseNumber = mt_rand(1, 5);
                $user->city = 'Berlin';
            } else {
                $resp = $ds->address2Geo($this->option('city') . ', Germany');

                if ($resp['json']['status'] === 'OK') {
                    $bounds = $resp['json']['results'][0]['geometry']['bounds'];
                    $lat = $this->random_latlon($bounds['southwest']['lat'], $bounds['northeast']['lat']);
                    $lon = $this->random_latlon($bounds['southwest']['lng'], $bounds['northeast']['lng']);
                    $addr = $ds->reverseGeo($lat, $lon);
                    dd($addr);
                } else {
                    $this->error("City \"{$this->option('city')}\" not found.");
                }
            }
            $generator = new Generator();
            // Make the user between 18 and 78 years ago
            $user->birthday = Carbon::now()->subYears(18)->subDays(mt_rand(0, 21900));
            $user->password = Hash::make('123456');
            $user->firstName = mt_rand(0,1) ? Person::firstNameFemale() : Person::firstNameMale();
            $user->lastName = (new Person($generator))->lastName();
            $user->email = "{$user->firstName}.{$user->lastName}" . time() . "@example.com";
            $user->phoneNumber = (new PhoneNumber($generator))->phoneNumber();
            $user->isRiskGroup = mt_rand(0,1);
            $user->healthStatus = ['healthy', 'quarantine', 'sick'][mt_rand(0,2)];
            $user->save();
            $this->line("New User: {$user->firstName} {$user->lastName} | {$user->getAddress()}");
        }
    }

    private function random_latlon($min, $max): float
    {
        $scale = 100000000;
        return mt_rand($min * $scale, $max * $scale) / $scale;
    }
}
