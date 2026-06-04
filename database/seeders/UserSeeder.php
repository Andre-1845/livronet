<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Andre',
            'email' => 'andre@livronet.com',
            'password' => bcrypt('123456'),

            'city_id' => 1,
            'school_id' => 1,
        ]);
    }
}
