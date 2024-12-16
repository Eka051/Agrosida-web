<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FillDatabaseWithAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:regions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill database with Indonesian region data';
    private $baseUrl = 'https://eka051.github.io/api-wilayah-indonesia/api/';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fill the database...');

        // Step 1: Fill Provinces
        $this->fillProvinces();

        $this->info('Database has been successfully filled.');
    }

    private function fillProvinces()
    {
        $provinces = Http::get($this->baseUrl . 'provinces.json')->json();
        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'id' => $province['id'],
                'province_name' => $province['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->info("Inserted province: {$province['name']}");

            $this->fillCities($province['id']);
        }
    }

    private function fillCities($provinceId)
    {
        $cities = Http::get($this->baseUrl . "regencies/{$provinceId}.json")->json();
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'id' => $city['id'],
                'province_id' => $provinceId,
                'city_name' => $city['name'],
                'type' => str_contains($city['name'], 'Kota') ? 'Kota' : 'Kabupaten',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->info("  Inserted city: {$city['name']}");

            $this->fillDistricts($city['id']);
        }
    }

    private function fillDistricts($cityId)
    {
        $districts = Http::get($this->baseUrl . "districts/{$cityId}.json")->json();
        foreach ($districts as $district) {
            DB::table('districts')->insert([
                'id' => $district['id'],
                'city_id' => $cityId,
                'district_name' => $district['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->info("    Inserted district: {$district['name']}");

            $this->fillVillages($district['id']);
        }
    }

    private function fillVillages($districtId)
    {
        $villages = Http::get($this->baseUrl . "villages/{$districtId}.json")->json();
        foreach ($villages as $village) {
            DB::table('villages')->insert([
                'id' => $village['id'],
                'district_id' => $districtId,
                'village_name' => $village['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->info("      Inserted village: {$village['name']}");
        }
    }
}
