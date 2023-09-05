<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create([
            "name" => "Región Cibao Norte",
            //            "code" => "01",
            //            "identifier" => "01"
        ]);

        Region::create([
            "name" => "Región Cibao Sur",
            //            "code" => "02",
            //            "identifier" => "02"
        ]);

        Region::create([
            "name" => "Región Cibao Nordeste",
            //            "code" => "03",
            //            "identifier" => "03"
        ]);

        Region::create([
            "name" => "Región Cibao Noroeste",
            //            "code" => "04",
            //            "identifier" => "04"
        ]);

        Region::create([
            "name" => "Región Valdesia",
            //            "code" => "05",
            //            "identifier" => "05"
        ]);

        Region::create([
            "name" => "Región Enriquillo",
            //            "code" => "06",
            //            "identifier" => "06"
        ]);

        Region::create([
            "name" => "Región El Valle",
            //            "code" => "07",
            //            "identifier" => "07"
        ]);

        Region::create([
            "name" => "Región Del Yuma",
            //            "code" => "08",
            //            "identifier" => "08"
        ]);

        Region::create([
            "name" => "Región Higuamo",
            //            "code" => "09",
            //            "identifier" => "09"
        ]);

        Region::create([
            "name" => "Región Ozama",
            //            "code" => "10",
            //            "identifier" => "10"
        ]);
    }
}
