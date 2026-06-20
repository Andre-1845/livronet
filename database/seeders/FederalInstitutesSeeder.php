<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\School;
use Illuminate\Database\Seeder;

class FederalInstitutesSeeder extends Seeder
{
    public function run(): void
    {
        $institutes = [

            ['name' => 'Instituto Federal do Acre', 'short_name' => 'IFAC', 'city' => 'Rio Branco'],
            ['name' => 'Instituto Federal do Amapá', 'short_name' => 'IFAP', 'city' => 'Macapá'],
            ['name' => 'Instituto Federal do Amazonas', 'short_name' => 'IFAM', 'city' => 'Manaus'],
            ['name' => 'Instituto Federal da Bahia', 'short_name' => 'IFBA', 'city' => 'Salvador'],
            ['name' => 'Instituto Federal Baiano', 'short_name' => 'IFBAIANO', 'city' => 'Salvador'],
            ['name' => 'Instituto Federal de Brasília', 'short_name' => 'IFB', 'city' => 'Brasília'],
            ['name' => 'Instituto Federal Catarinense', 'short_name' => 'IFC', 'city' => 'Blumenau'],
            ['name' => 'Instituto Federal do Ceará', 'short_name' => 'IFCE', 'city' => 'Fortaleza'],
            ['name' => 'Instituto Federal do Espírito Santo', 'short_name' => 'IFES', 'city' => 'Vitória'],
            ['name' => 'Instituto Federal de Goiás', 'short_name' => 'IFG', 'city' => 'Goiânia'],
            ['name' => 'Instituto Federal Goiano', 'short_name' => 'IFGOIANO', 'city' => 'Goiânia'],
            ['name' => 'Instituto Federal do Maranhão', 'short_name' => 'IFMA', 'city' => 'São Luís'],
            ['name' => 'Instituto Federal de Minas Gerais', 'short_name' => 'IFMG', 'city' => 'Belo Horizonte'],
            ['name' => 'Instituto Federal do Norte de Minas Gerais', 'short_name' => 'IFNMG', 'city' => 'Montes Claros'],
            ['name' => 'Instituto Federal do Sul de Minas Gerais', 'short_name' => 'IFSULDEMINAS', 'city' => 'Pouso Alegre'],
            ['name' => 'Instituto Federal do Sudeste de Minas Gerais', 'short_name' => 'IFSUDESTEMG', 'city' => 'Juiz de Fora'],
            ['name' => 'Instituto Federal do Triângulo Mineiro', 'short_name' => 'IFTM', 'city' => 'Uberaba'],
            ['name' => 'Instituto Federal de Mato Grosso', 'short_name' => 'IFMT', 'city' => 'Cuiabá'],
            ['name' => 'Instituto Federal de Mato Grosso do Sul', 'short_name' => 'IFMS', 'city' => 'Campo Grande'],
            ['name' => 'Instituto Federal do Pará', 'short_name' => 'IFPA', 'city' => 'Belém'],
            ['name' => 'Instituto Federal da Paraíba', 'short_name' => 'IFPB', 'city' => 'João Pessoa'],
            ['name' => 'Instituto Federal do Paraná', 'short_name' => 'IFPR', 'city' => 'Curitiba'],
            ['name' => 'Instituto Federal de Pernambuco', 'short_name' => 'IFPE', 'city' => 'Recife'],
            ['name' => 'Instituto Federal do Sertão Pernambucano', 'short_name' => 'IFSERTAOPE', 'city' => 'Petrolina'],
            ['name' => 'Instituto Federal do Piauí', 'short_name' => 'IFPI', 'city' => 'Teresina'],
            ['name' => 'Instituto Federal do Rio de Janeiro', 'short_name' => 'IFRJ', 'city' => 'Rio de Janeiro'],
            ['name' => 'Instituto Federal Fluminense', 'short_name' => 'IFF', 'city' => 'Campos dos Goytacazes'],
            ['name' => 'Instituto Federal do Rio Grande do Norte', 'short_name' => 'IFRN', 'city' => 'Natal'],
            ['name' => 'Instituto Federal do Rio Grande do Sul', 'short_name' => 'IFRS', 'city' => 'Bento Gonçalves'],
            ['name' => 'Instituto Federal Farroupilha', 'short_name' => 'IFFAR', 'city' => 'Santa Maria'],
            ['name' => 'Instituto Federal Sul-rio-grandense', 'short_name' => 'IFSUL', 'city' => 'Pelotas'],
            ['name' => 'Instituto Federal de Rondônia', 'short_name' => 'IFRO', 'city' => 'Porto Velho'],
            ['name' => 'Instituto Federal de Roraima', 'short_name' => 'IFRR', 'city' => 'Boa Vista'],
            ['name' => 'Instituto Federal de Santa Catarina', 'short_name' => 'IFSC', 'city' => 'Florianópolis'],
            ['name' => 'Instituto Federal de São Paulo', 'short_name' => 'IFSP', 'city' => 'São Paulo'],
            ['name' => 'Instituto Federal de Sergipe', 'short_name' => 'IFS', 'city' => 'Aracaju'],
            ['name' => 'Instituto Federal do Tocantins', 'short_name' => 'IFTO', 'city' => 'Palmas'],

        ];

        foreach ($institutes as $institute) {

            $city = City::where('name', $institute['city'])->first();

            if (! $city) {

                $this->command->warn(
                    "Cidade não encontrada: {$institute['city']}"
                );

                continue;
            }

            School::updateOrCreate(
                [
                    'city_id' => $city->id,
                    'name' => $institute['name'],
                ],
                [
                    'short_name' => $institute['short_name'],
                    'type' => 'federal_institute',
                ]
            );
        }
    }
}
