<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [

            [
                'city_id' => 1,
                'name' => 'Colégio Getúlio Vargas',
            ],

            [
                'city_id' => 3,
                'name' => 'Colégio Batista',
            ],

            [
                'city_id' => 8,
                'name' => 'SESI Barra Mansa',
            ],

            [
                'city_id' => 2,
                'name' => 'CMB',
            ],

        ];

        foreach ($schools as $school) {

            School::create($school);
        }
    }
}
