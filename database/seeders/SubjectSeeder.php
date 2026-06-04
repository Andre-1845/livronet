<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [

            'Artes',
            'Biologia',
            'Ciências',
            'Desenho',
            'Educação Física',
            'Espanhol',
            'Filosofia',
            'Física',
            'Francês',
            'Geografia',
            'História',
            'Informática',
            'Inglês',
            'Literatura',
            'Matemática',
            'Música',
            'Português',
            'Química',
            'Redação',
            'Sociologia',

        ];

        foreach ($subjects as $subject) {

            Subject::firstOrCreate([
                'name' => $subject,
            ]);
        }
    }
}
