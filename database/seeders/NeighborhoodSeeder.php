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
            'averagePrice' => 4000.00,
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
            'averagePrice' => 6000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Cerros de Arroyo Hondo',
            //            'code' => '003',
            //            'identifier' => '100101003',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Parque Zoológico Nacional',
            //            'code' => '004',
            //            'identifier' => '100101004',
            //            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Puerto Isabela',
            //            'code' => '005',
            //            'identifier' => '100101005',
            'averagePrice' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LA ZURZA',
            //            'code' => '006',
            //            'identifier' => '100101006',
            'averagePrice' => 1000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Capotillo',
            //            'code' => '007',
            //            'identifier' => '100101007',
            'averagePrice' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Simón Bolívar',
            //            'code' => '008',
            //            'identifier' => '100101008',
            'averagePrice' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);


        Neighborhood::create([
            'name' => '24 de Abril',
            //            'code' => '009',
            //            'identifier' => '100101009',
            'averagePrice' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Gualey',
            //            'code' => '010',
            //            'identifier' => '100101010',
            'averagePrice' => 700.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Espaillat',
            //            'code' => '011',
            //            'identifier' => '100101011',
            'averagePrice' => 4000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);


        Neighborhood::create([
            'name' => 'Ensanche Luperón',
            //            'code' => '012',
            //            'identifier' => '100101012',
            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villas Agrícolas',
            //            'code' => '013',
            //            'identifier' => '100101013',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Cristo Rey',
            //            'code' => '014',
            //            'identifier' => '100101014',
            'averagePrice' => 2000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Nuevo Arroyo Hondo',
            //            'code' => '015',
            //            'identifier' => '100101015',
            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Palma Real',
            //            'code' => '016',
            //            'identifier' => '100101016',
            'averagePrice' => 4000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Peralejos',
            //            'code' => '017',
            //            'identifier' => '100101017',
            'averagePrice' => 1500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Altos de Arroyo Hondo',
            //            'code' => '018',
            //            'identifier' => '100101018',
            'averagePrice' => 7500.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Ríos',
            //            'code' => '019',
            //            'identifier' => '100101019',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardín Botánico',
            //            'code' => '020',
            //            'identifier' => '100101020',
            //            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Viejo Arroyo Hondo',
            //            'code' => '021',
            //            'identifier' => '100101021',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche La Fe',
            //            'code' => '022',
            //            'identifier' => '100101022',
            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Juana',
            //            'code' => '023',
            //            'identifier' => '100101023',
            'averagePrice' => 8000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Consuelo',
            //            'code' => '024',
            //            'identifier' => '100101024',
            'averagePrice' => 12000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mejoramiento Social',
            //            'code' => '025',
            //            'identifier' => '100101025',
            'averagePrice' => 7000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'María Auxiliadora',
            //            'code' => '026',
            //            'identifier' => '100101026',
            'averagePrice' => 5000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Domingo Savio',
            //            'code' => '027',
            //            'identifier' => '100101027',
            'averagePrice' => 800.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Villa Francisca',
            //            'code' => '028',
            //            'identifier' => '100101028',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Carlos',
            //            'code' => '029',
            //            'identifier' => '100101029',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Juan Bosco (Don Bosco)',
            //            'code' => '030',
            //            'identifier' => '100101030',
            'averagePrice' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Miraflores',
            //            'code' => '031',
            //            'identifier' => '100101031',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Centro Olímpico Juan Pablo Duarte',
            //            'code' => '032',
            //            'identifier' => '100101032',
            //            'averagePrice' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Naco',
            //            'code' => '033',
            //            'identifier' => '100101033',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Piantini',
            //            'code' => '034',
            //            'identifier' => '100101034',
            'averagePrice' => 50000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardines del Norte',
            //            'code' => '035',
            //            'identifier' => '100101035',
            'averagePrice' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'San Gerónimo',
            //            'code' => '036',
            //            'identifier' => '100101036',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Prados',
            //            'code' => '037',
            //            'identifier' => '100101037',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Julieta Morales',
            //            'code' => '038',
            //            'identifier' => '100101038',
            'averagePrice' => 35000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Restauradores',
            //            'code' => '039',
            //            'identifier' => '100101039',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Millones',
            //            'code' => '040',
            //            'identifier' => '100101040',
            'averagePrice' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ensanche Quisqueya',
            //            'code' => '041',
            //            'identifier' => '100101041',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'La Julia',
            //            'code' => '042',
            //            'identifier' => '100101042',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'La Esperilla',
            //            'code' => '043',
            //            'identifier' => '100101043',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Gascue',
            //            'code' => '044',
            //            'identifier' => '100101044',
            'averagePrice' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Colonial',
            //            'code' => '045',
            //            'identifier' => '100101045',
            'averagePrice' => 30000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Nueva',
            //            'code' => '046',
            //            'identifier' => '100101046',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Universitaria',
            //            'code' => '047',
            //            'identifier' => '100101047',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Nuestra Señora de La Paz',
            //            'code' => '049',
            //            'identifier' => '100101049',
            'averagePrice' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Bella Vista',
            //            'code' => '050',
            //            'identifier' => '100101050',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mirador Norte',
            //            'code' => '051',
            //            'identifier' => '100101051',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Renacimiento',
            //            'code' => '052',
            //            'identifier' => '100101052',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Los Cacicazgos',
            //            'code' => '053',
            //            'identifier' => '100101053',
            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Mirador Sur',
            //            'code' => '054',
            //            'identifier' => '100101054',
            'averagePrice' => 45000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Parque Mirador Sur (Paseo de Los Indios)',
            //            'code' => '055',
            //            'identifier' => '100101055',
            //            'averagePrice' => 40000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Honduras del Norte',
            //            'code' => '056',
            //            'identifier' => '100101056',
            'averagePrice' => 15000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Buenos Aires del Mirador',
            //            'code' => '057',
            //            'identifier' => '100101057',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Jardines del Sur',
            //            'code' => '058',
            //            'identifier' => '100101058',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Átala',
            //            'code' => '059',
            //            'identifier' => '100101059',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'General Antonio Duvergé (Honduras)',
            //            'code' => '060',
            //            'identifier' => '100101060',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Centro de Los Héroes',
            //            'code' => '061',
            //            'identifier' => '100101061',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'El Cacique',
            //            'code' => '062',
            //            'identifier' => '100101062',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => '30 de Mayo',
            //            'code' => '063',
            //            'identifier' => '100101063',
            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Ciudad Ganadera',
            //            'code' => '064',
            //            'identifier' => '100101064',
            //            'averagePrice' => 10000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Urb. Tropical',
            //            'code' => '065',
            //            'identifier' => '100101065',
            'averagePrice' => 20000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Miramar',
            //            'code' => '066',
            //            'identifier' => '100101066',
            'averagePrice' => 25000.00,
            'municipality_id' => 1,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '01',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'Honduras del Oeste (INVI)',
            //            'code' => '067',
            //            'identifier' => '100101067',
            'averagePrice' => 15000.00,
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
            'averagePrice' => 15000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ALMA ROSA',
            //            'code' => '002',
            //            'identifier' => '103201002',
            'averagePrice' => 20000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'VILLA FARO',
            //            'code' => '003',
            //            'identifier' => '103201003',
            'averagePrice' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'MENDOZA',
            //            'code' => '004',
            //            'identifier' => '103201004',
            'averagePrice' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRINITARIOS',
            //            'code' => '005',
            //            'identifier' => '103201005',
            'averagePrice' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ENS. LAS AMERICAS',
            //            'code' => '006',
            //            'identifier' => '103201006',
            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'FARO A COLON',
            //            'code' => '007',
            //            'identifier' => '103201007',
            //            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'VILLA DUARTE',
            //            'code' => '008',
            //            'identifier' => '103201008',
            'averagePrice' => 6000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MAMEYES',
            //            'code' => '009',
            //            'identifier' => '103201009',
            'averagePrice' => 5000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'ENSANCHE LA ISABELITA',
            //            'code' => '010',
            //            'identifier' => '103201010',
            'averagePrice' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRES OJOS',
            //            'code' => '011',
            //            'identifier' => '103201011',
            'averagePrice' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS TRES BRAZOS',
            //            'code' => '012',
            //            'identifier' => '103201012',
            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MINA NORTE',
            //            'code' => '013',
            //            'identifier' => '103201013',
            'averagePrice' => 2500.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS MINA SUR',
            //            'code' => '014',
            //            'identifier' => '103201014',
            'averagePrice' => 5000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'CANCINO',
            //            'code' => '015',
            //            'identifier' => '103201015',
            'averagePrice' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LA UREÑA',
            //            'code' => '016',
            //            'identifier' => '103201016',
            'averagePrice' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'LOS FRAILES',
            //            'code' => '017',
            //            'identifier' => '103201017',
            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'BRISAS DEL ESTE',
            //            'code' => '018',
            //            'identifier' => '103201018',
            'averagePrice' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'JUAN LOPEZ',
            //            'code' => '019',
            //            'identifier' => '103201019',
            'averagePrice' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'BRISA ORIENTAL',
            //            'code' => '020',
            //            'identifier' => '103201020',
            'averagePrice' => 10000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'NUEVA JERUSALÉN',
            //            'code' => '021',
            //            'identifier' => '103201021',
            'averagePrice' => 3000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'CIUDAD JUAN BOSH',
            //            'code' => '022',
            //            'identifier' => '103201022',
            //            'averagePrice' => 12000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'SAN JOSE DE MENDOZA',
            //            'code' => '023',
            //            'identifier' => '103201023',
            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'HAINAMOSA',
            //            'code' => '024',
            //            'identifier' => '103201024',
            'averagePrice' => 6000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'EL ALMIRANTE',
            //            'code' => '025',
            //            'identifier' => '103201025',
            'averagePrice' => 4000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);

        Neighborhood::create([
            'name' => 'EL TAMARINDO',
            //            'code' => '026',
            //            'identifier' => '103201026',
            'averagePrice' => 2000.00,
            'municipality_id' => 2,
            //            'municipalityCode' => '01',
            //            'provinceCode' => '32',
            //            'regionCode' => '10',
        ]);
    }
}
