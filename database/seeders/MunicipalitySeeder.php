<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Distrito Nacional
        Municipality::create([
            "name" => "Santo Domingo de Guzmán",
            //            "code" => "01",
            //            "identifier" => "100101",
            "province_id" => 1,
            //            "provinceCode" => "01",
            //            "regionCode" => "10"
        ]);

        //Santo Domingo
        Municipality::create([
            "name" => "Santo Domingo Este",
            //            "code" => "01",
            //            "identifier" => "103201",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "Santo Domingo Oeste",
            //            "code" => "02",
            //            "identifier" => "103202",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "Santo Domingo Norte",
            //            "code" => "03",
            //            "identifier" => "103203",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "Boca Chica",
            //            "code" => "04",
            //            "identifier" => "103204",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "San Antonio de Guerra",
            //            "code" => "05",
            //            "identifier" => "103205",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "Los Alcarrizos",
            //            "code" => "06",
            //            "identifier" => "103206",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);

        Municipality::create([
            "name" => "Pedro Brand",
            //            "code" => "07",
            //            "identifier" => "103207",
            "province_id" => 32,
            //            "provinceCode" => "32",
            //            "regionCode" => "10"
        ]);
    }
}
