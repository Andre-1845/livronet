<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
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

            State::firstOrCreate(
                [
                    'uf' => $estado['sigla'],
                ],
                [
                    'name' => $estado['nome'],
                ]
            );
        }
    }
}
