<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Santo Domingo de Guzmán
        Neighborhood::create([
            'name' => 'La Isabela',
            //            'code' => '001',
            //            'identifier' => '100101001',
            'average_price' => 4000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        //Santo Domingo Este
        Neighborhood::create([
            'name' => 'Arroyo Manzano',
            //            'code' => '002',
            //            'identifier' => '100101002',
            'average_price' => 6000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Cerros de Arroyo Hondo',
            //            'code' => '003',
            //            'identifier' => '100101003',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Parque Zoológico Nacional',
            //            'code' => '004',
            //            'identifier' => '100101004',
            //            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Puerto Isabela',
            //            'code' => '005',
            //            'identifier' => '100101005',
            'average_price' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LA ZURZA',
            //            'code' => '006',
            //            'identifier' => '100101006',
            'average_price' => 1000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Capotillo',
            //            'code' => '007',
            //            'identifier' => '100101007',
            'average_price' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Simón Bolívar',
            //            'code' => '008',
            //            'identifier' => '100101008',
            'average_price' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);


        Neighborhood::create([
            'name' => '24 de Abril',
            //            'code' => '009',
            //            'identifier' => '100101009',
            'average_price' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Gualey',
            //            'code' => '010',
            //            'identifier' => '100101010',
            'average_price' => 700.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Espaillat',
            //            'code' => '011',
            //            'identifier' => '100101011',
            'average_price' => 4000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);


        Neighborhood::create([
            'name' => 'Ensanche Luperón',
            //            'code' => '012',
            //            'identifier' => '100101012',
            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villas Agrícolas',
            //            'code' => '013',
            //            'identifier' => '100101013',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Cristo Rey',
            //            'code' => '014',
            //            'identifier' => '100101014',
            'average_price' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Nuevo Arroyo Hondo',
            //            'code' => '015',
            //            'identifier' => '100101015',
            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Palma Real',
            //            'code' => '016',
            //            'identifier' => '100101016',
            'average_price' => 4000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Peralejos',
            //            'code' => '017',
            //            'identifier' => '100101017',
            'average_price' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Altos de Arroyo Hondo',
            //            'code' => '018',
            //            'identifier' => '100101018',
            'average_price' => 7500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Ríos',
            //            'code' => '019',
            //            'identifier' => '100101019',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardín Botánico',
            //            'code' => '020',
            //            'identifier' => '100101020',
            //            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Viejo Arroyo Hondo',
            //            'code' => '021',
            //            'identifier' => '100101021',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche La Fe',
            //            'code' => '022',
            //            'identifier' => '100101022',
            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Juana',
            //            'code' => '023',
            //            'identifier' => '100101023',
            'average_price' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Consuelo',
            //            'code' => '024',
            //            'identifier' => '100101024',
            'average_price' => 12000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mejoramiento Social',
            //            'code' => '025',
            //            'identifier' => '100101025',
            'average_price' => 7000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'María Auxiliadora',
            //            'code' => '026',
            //            'identifier' => '100101026',
            'average_price' => 5000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Domingo Savio',
            //            'code' => '027',
            //            'identifier' => '100101027',
            'average_price' => 800.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Francisca',
            //            'code' => '028',
            //            'identifier' => '100101028',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Carlos',
            //            'code' => '029',
            //            'identifier' => '100101029',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Juan Bosco (Don Bosco)',
            //            'code' => '030',
            //            'identifier' => '100101030',
            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Miraflores',
            //            'code' => '031',
            //            'identifier' => '100101031',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Centro Olímpico Juan Pablo Duarte',
            //            'code' => '032',
            //            'identifier' => '100101032',
            //            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Naco',
            //            'code' => '033',
            //            'identifier' => '100101033',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Piantini',
            //            'code' => '034',
            //            'identifier' => '100101034',
            'average_price' => 50000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardines del Norte',
            //            'code' => '035',
            //            'identifier' => '100101035',
            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Gerónimo',
            //            'code' => '036',
            //            'identifier' => '100101036',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Prados',
            //            'code' => '037',
            //            'identifier' => '100101037',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Julieta Morales',
            //            'code' => '038',
            //            'identifier' => '100101038',
            'average_price' => 35000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Restauradores',
            //            'code' => '039',
            //            'identifier' => '100101039',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Millones',
            //            'code' => '040',
            //            'identifier' => '100101040',
            'average_price' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Quisqueya',
            //            'code' => '041',
            //            'identifier' => '100101041',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'La Julia',
            //            'code' => '042',
            //            'identifier' => '100101042',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'La Esperilla',
            //            'code' => '043',
            //            'identifier' => '100101043',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Gascue',
            //            'code' => '044',
            //            'identifier' => '100101044',
            'average_price' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Colonial',
            //            'code' => '045',
            //            'identifier' => '100101045',
            'average_price' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Nueva',
            //            'code' => '046',
            //            'identifier' => '100101046',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Universitaria',
            //            'code' => '047',
            //            'identifier' => '100101047',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Nuestra Señora de La Paz',
            //            'code' => '049',
            //            'identifier' => '100101049',
            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Bella Vista',
            //            'code' => '050',
            //            'identifier' => '100101050',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mirador Norte',
            //            'code' => '051',
            //            'identifier' => '100101051',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Renacimiento',
            //            'code' => '052',
            //            'identifier' => '100101052',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Cacicazgos',
            //            'code' => '053',
            //            'identifier' => '100101053',
            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mirador Sur',
            //            'code' => '054',
            //            'identifier' => '100101054',
            'average_price' => 45000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Parque Mirador Sur (Paseo de Los Indios)',
            //            'code' => '055',
            //            'identifier' => '100101055',
            //            'average_price' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Honduras del Norte',
            //            'code' => '056',
            //            'identifier' => '100101056',
            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Buenos Aires del Mirador',
            //            'code' => '057',
            //            'identifier' => '100101057',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardines del Sur',
            //            'code' => '058',
            //            'identifier' => '100101058',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Átala',
            //            'code' => '059',
            //            'identifier' => '100101059',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'General Antonio Duvergé (Honduras)',
            //            'code' => '060',
            //            'identifier' => '100101060',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Centro de Los Héroes',
            //            'code' => '061',
            //            'identifier' => '100101061',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'El Cacique',
            //            'code' => '062',
            //            'identifier' => '100101062',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => '30 de Mayo',
            //            'code' => '063',
            //            'identifier' => '100101063',
            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Ganadera',
            //            'code' => '064',
            //            'identifier' => '100101064',
            //            'average_price' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Urb. Tropical',
            //            'code' => '065',
            //            'identifier' => '100101065',
            'average_price' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Miramar',
            //            'code' => '066',
            //            'identifier' => '100101066',
            'average_price' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Honduras del Oeste (INVI)',
            //            'code' => '067',
            //            'identifier' => '100101067',
            'average_price' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        //Santo Domingo Este
        Neighborhood::create([
            'name' => 'ENSANCHE OZAMA',
            //            'code' => '001',
            //            'identifier' => '103201001',
            'average_price' => 15000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ALMA ROSA',
            //            'code' => '002',
            //            'identifier' => '103201002',
            'average_price' => 20000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'VILLA FARO',
            //            'code' => '003',
            //            'identifier' => '103201003',
            'average_price' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'MENDOZA',
            //            'code' => '004',
            //            'identifier' => '103201004',
            'average_price' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRINITARIOS',
            //            'code' => '005',
            //            'identifier' => '103201005',
            'average_price' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ENS. LAS AMERICAS',
            //            'code' => '006',
            //            'identifier' => '103201006',
            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'FARO A COLON',
            //            'code' => '007',
            //            'identifier' => '103201007',
            //            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'VILLA DUARTE',
            //            'code' => '008',
            //            'identifier' => '103201008',
            'average_price' => 6000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MAMEYES',
            //            'code' => '009',
            //            'identifier' => '103201009',
            'average_price' => 5000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ENSANCHE LA ISABELITA',
            //            'code' => '010',
            //            'identifier' => '103201010',
            'average_price' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRES OJOS',
            //            'code' => '011',
            //            'identifier' => '103201011',
            'average_price' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRES BRAZOS',
            //            'code' => '012',
            //            'identifier' => '103201012',
            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MINA NORTE',
            //            'code' => '013',
            //            'identifier' => '103201013',
            'average_price' => 2500.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MINA SUR',
            //            'code' => '014',
            //            'identifier' => '103201014',
            'average_price' => 5000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'CANCINO',
            //            'code' => '015',
            //            'identifier' => '103201015',
            'average_price' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LA UREÑA',
            //            'code' => '016',
            //            'identifier' => '103201016',
            'average_price' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS FRAILES',
            //            'code' => '017',
            //            'identifier' => '103201017',
            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'BRISAS DEL ESTE',
            //            'code' => '018',
            //            'identifier' => '103201018',
            'average_price' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'JUAN LOPEZ',
            //            'code' => '019',
            //            'identifier' => '103201019',
            'average_price' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'BRISA ORIENTAL',
            //            'code' => '020',
            //            'identifier' => '103201020',
            'average_price' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'NUEVA JERUSALÉN',
            //            'code' => '021',
            //            'identifier' => '103201021',
            'average_price' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'CIUDAD JUAN BOSH',
            //            'code' => '022',
            //            'identifier' => '103201022',
            //            'average_price' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'SAN JOSE DE MENDOZA',
            //            'code' => '023',
            //            'identifier' => '103201023',
            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'HAINAMOSA',
            //            'code' => '024',
            //            'identifier' => '103201024',
            'average_price' => 6000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'EL ALMIRANTE',
            //            'code' => '025',
            //            'identifier' => '103201025',
            'average_price' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'EL TAMARINDO',
            //            'code' => '026',
            //            'identifier' => '103201026',
            'average_price' => 2000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);
    }
}
