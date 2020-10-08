<?php

use App\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'description' => 'US East (Ohio)',
            'id' => 'us-east-2'
        ]);
        Region::create([
            'description' => 'US East (N. Virginia)',
            'id' => 'us-east-1'
        ]);
        Region::create([
            'description' => 'US West (N. California)',
            'id' => 'us-west-1'
        ]);
        Region::create([
            'description' => 'US West (Oregon)',
            'id' => 'us-west-2'
        ]);
        Region::create([
            'description' => 'Africa (Cape Town)',
            'id' => 'af-south-1'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Hong Kong)',
            'id' => 'ap-east-1'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Mumbai)',
            'id' => 'ap-south-1'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Osaka-Local)',
            'id' => 'ap-northeast-3'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Seoul)',
            'id' => 'ap-northeast-2'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Singapore)',
            'id' => 'ap-southeast-1'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Sydney)',
            'id' => 'ap-southeast-2'
        ]);
        Region::create([
            'description' => 'Asia Pacific (Tokyo)',
            'id' => 'ap-northeast-1'
        ]);
        Region::create([
            'description' => 'Canada (Central)',
            'id' => 'ca-central-1'
        ]);
        Region::create([
            'description' => 'China (Beijing)',
            'id' => 'cn-north-1'
        ]);
        Region::create([
            'description' => 'China (Ningxia)',
            'id' => 'cn-northwest-1'
        ]);
        Region::create([
            'description' => 'Europe (Frankfurt)',
            'id' => 'eu-central-1'
        ]);
        Region::create([
            'description' => 'Europe (Ireland)',
            'id' => 'eu-west-1'
        ]);
        Region::create([
            'description' => 'Europe (London)',
            'id' => 'eu-west-2'
        ]);
        Region::create([
            'description' => 'Europe (Milan)',
            'id' => 'eu-south-1'
        ]);
        Region::create([
            'description' => 'Europe (Paris)',
            'id' => 'eu-west-3'
        ]);
        Region::create([
            'description' => 'Europe (Stockholm)',
            'id' => 'eu-north-1'
        ]);
        Region::create([
            'description' => 'Middle East (Bahrain)',
            'id' => 'me-south-1'
        ]);
        Region::create([
            'description' => 'South America (São Paulo)',
            'id' => 'sa-east-1'
        ]);
        Region::create([
            'description' => 'AWS GovCloud (US-East)',
            'id' => 'us-gov-east-1'
        ]);
        Region::create([
            'description' => 'AWS GovCloud (US)',
            'id' => 'us-gov-west-1'
        ]);
    }
}
