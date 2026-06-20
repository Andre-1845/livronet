<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\School;
use Illuminate\Database\Seeder;

class MilitarySchoolsSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [

            [
                'name' => 'Colégio Militar de Belém',
                'short_name' => 'CMBEL',
                'city' => 'Belém',
            ],
            [
                'name' => 'Colégio Militar de Belo Horizonte',
                'short_name' => 'CMBH',
                'city' => 'Belo Horizonte',
            ],
            [
                'name' => 'Colégio Militar de Brasília',
                'short_name' => 'CMB',
                'city' => 'Brasília',
            ],
            [
                'name' => 'Colégio Militar de Campo Grande',
                'short_name' => 'CMCG',
                'city' => 'Campo Grande',
            ],
            [
                'name' => 'Colégio Militar de Curitiba',
                'short_name' => 'CMC',
                'city' => 'Curitiba',
            ],
            [
                'name' => 'Colégio Militar de Fortaleza',
                'short_name' => 'CMF',
                'city' => 'Fortaleza',
            ],
            [
                'name' => 'Colégio Militar de Goiânia',
                'short_name' => 'CMGO',
                'city' => 'Goiânia',
            ],
            [
                'name' => 'Colégio Militar de Juiz de Fora',
                'short_name' => 'CMJF',
                'city' => 'Juiz de Fora',
            ],
            [
                'name' => 'Colégio Militar de Manaus',
                'short_name' => 'CMM',
                'city' => 'Manaus',
            ],
            [
                'name' => 'Colégio Militar de Porto Alegre',
                'short_name' => 'CMPA',
                'city' => 'Porto Alegre',
            ],
            [
                'name' => 'Colégio Militar do Recife',
                'short_name' => 'CMR',
                'city' => 'Recife',
            ],
            [
                'name' => 'Colégio Militar do Rio de Janeiro',
                'short_name' => 'CMRJ',
                'city' => 'Rio de Janeiro',
            ],
            [
                'name' => 'Colégio Militar de Salvador',
                'short_name' => 'CMS',
                'city' => 'Salvador',
            ],
            [
                'name' => 'Colégio Militar de Santa Maria',
                'short_name' => 'CMSM',
                'city' => 'Santa Maria',
            ],
            [
                'name' => 'Colégio Militar de São Paulo',
                'short_name' => 'CMSP',
                'city' => 'São Paulo',
            ],

        ];

        foreach ($schools as $school) {

            $city = City::where('name', $school['city'])->first();

            if (! $city) {
                $this->command->warn(
                    "Cidade não encontrada: {$school['city']}"
                );

                continue;
            }

            School::updateOrCreate(
                [
                    'city_id' => $city->id,
                    'name' => $school['name'],
                ],
                [
                    'short_name' => $school['short_name'],
                    'type' => 'military_school',
                ]
            );
        }
    }
}
