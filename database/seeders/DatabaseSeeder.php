<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StateSeeder::class,
            CitySeeder::class,
            GradeSeeder::class,
            SubjectSeeder::class,
            MilitarySchoolsSeeder::class,
            FederalInstitutesSeeder::class,
            UserSeeder::class,
            BookSeeder::class,

        ]);
    }
}