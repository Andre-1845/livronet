<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $json = json_decode(
            file_get_contents(
                database_path('seeders/data/estados-cidades.json')
            ),
            true
        );

        foreach ($json['estados'] as $estado) {

            $state = State::where(
                'uf',
                $estado['sigla']
            )->first();

            if (!$state) {
                continue;
            }

            foreach ($estado['cidades'] as $cidade) {

                City::updateOrCreate(
                    [
                        'name' => $cidade,
                        'state' => $estado['sigla'],
                    ],
                    [
                        'state_id' => $state->id,
                    ]
                );
            }
        }
    }
}
