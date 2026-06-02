<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [

            'Matemática',
            'Português',
            'História',
            'Geografia',
            'Física',
            'Química',
            'Biologia',
            'Ciências',
            'Inglês',
            'Filosofia',
            'Sociologia',
            'Artes',
            'Educação Física',
            'Literatura',
            'Redação',
            'Espanhol',
            'Informática',

        ];

        foreach ($subjects as $subject) {

            Subject::create([
                'name' => $subject,
            ]);
        }
    }
}
