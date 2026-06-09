<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StateSeeder::class,
            GradeSeeder::class,
            SubjectSeeder::class,
            CitySeeder::class,
            SchoolSeeder::class,
            UserSeeder::class,
            BookSeeder::class,

        ]);
    }
}