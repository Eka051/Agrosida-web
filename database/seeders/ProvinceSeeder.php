<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['province_name' => 'ACEH'],
            ['province_name' => 'SUMATERA UTARA'],
            ['province_name' => 'SUMATERA BARAT'],
            ['province_name' => 'RIAU'],
            ['province_name' => 'JAMBI'],
            ['province_name' => 'SUMATERA SELATAN'],
            ['province_name' => 'BENGKULU'],
            ['province_name' => 'LAMPUNG'],
            ['province_name' => 'KEPULAUAN BANGKA BELITUNG'],
            ['province_name' => 'KEPULAUAN RIAU'],
            ['province_name' => 'DKI JAKARTA'],
            ['province_name' => 'JAWA BARAT'],
            ['province_name' => 'JAWA TENGAH'],
            ['province_name' => 'DI YOGYAKARTA'],
            ['province_name' => 'JAWA TIMUR'],
            ['province_name' => 'BANTEN'],
            ['province_name' => 'BALI'],
            ['province_name' => 'NUSA TENGGARA BARAT'],
            ['province_name' => 'NUSA TENGGARA TIMUR'],
            ['province_name' => 'KALIMANTAN BARAT'],
            ['province_name' => 'KALIMANTAN TENGAH'],
            ['province_name' => 'KALIMANTAN SELATAN'],
            ['province_name' => 'KALIMANTAN TIMUR'],
            ['province_name' => 'KALIMANTAN UTARA'],
            ['province_name' => 'SULAWESI UTARA'],
            ['province_name' => 'SULAWESI TENGAH'],
            ['province_name' => 'SULAWESI SELATAN'],
            ['province_name' => 'SULAWESI TENGGARA'],
            ['province_name' => 'GORONTALO'],
            ['province_name' => 'SULAWESI BARAT'],
            ['province_name' => 'MALUKU'],
            ['province_name' => 'MALUKU UTARA'],
            ['province_name' => 'PAPUA'],
            ['province_name' => 'PAPUA BARAT'],
            ['province_name' => 'PAPUA TENGAH'],
            ['province_name' => 'PAPUA PEGUNUNGAN'],
            ['province_name' => 'PAPUA SELATAN']
        ]);
    }
}
