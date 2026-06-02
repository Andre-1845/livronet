<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [

            [
                'name' => 'Volta Redonda',
                'state' => 'RJ',
            ],

            [
                'name' => 'Brasilia',
                'state' => 'DF',
            ],

            [
                'name' => 'Goiânia',
                'state' => 'GO',
            ],

            [
                'name' => 'Juiz de Fora',
                'state' => 'MG',
            ],

            [
                'name' => 'Belo Horizonte',
                'state' => 'MG',
            ],

            [
                'name' => 'Rio de Janeiro',
                'state' => 'RJ',
            ],

            [
                'name' => 'São Paulo',
                'state' => 'SP',
            ],

            [
                'name' => 'Barra Mansa',
                'state' => 'RJ',
            ],

            [
                'name' => 'Resende',
                'state' => 'RJ',
            ],

        ];

        foreach ($cities as $city) {

            City::create($city);
        }
    }
}
