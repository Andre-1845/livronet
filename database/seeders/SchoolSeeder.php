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
                'city_id' => 3713,
                'name' => 'Colégio Getúlio Vargas',
            ],

            [
                'city_id' => 1012,
                'name' => 'Colégio Batista',
            ],

            [
                'city_id' => 3629,
                'name' => 'SESI Barra Mansa',
            ],

            [
                'city_id' => 806,
                'name' => 'CMB',
            ],

        ];

        foreach ($schools as $school) {

            School::firstOrCreate($school);
        }
    }
}
