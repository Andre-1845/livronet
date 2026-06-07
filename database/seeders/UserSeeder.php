<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            [
                'name' => 'Joao da Silva',
                'email' => 'silva@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 1, // Volta Redonda
                'school_id' => 1, // Colégio Getúlio Vargas
                'whatsapp' => '24999990001',
                'instagram' => '@joao.silva',
            ],

            [
                'name' => 'Mario Gomes',
                'email' => 'mario@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 3, // Goiânia
                'school_id' => 2, // Colégio Batista
                'whatsapp' => '62999990002',
                'instagram' => '@mario.gomes',
            ],

            [
                'name' => 'Luciana Alves',
                'email' => 'luciana@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 2, // Brasília
                'school_id' => 4, // CMB
                'whatsapp' => '61999990003',
                'instagram' => '@luciana.alves',
            ],

            [
                'name' => 'Fernanda Costa',
                'email' => 'fernanda@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 8, // Barra Mansa
                'school_id' => 3, // SESI Barra Mansa
                'whatsapp' => '24999990004',
                'instagram' => '@fernanda.costa',
            ],

            [
                'name' => 'Carlos Pereira',
                'email' => 'carlos@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 9, // Resende
                'school_id' => 1, // Colégio Getúlio Vargas
                'whatsapp' => '24999990005',
                'instagram' => '@carlos.pereira',
            ],

            [
                'name' => 'Ana Beatriz Souza',
                'email' => 'ana@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 6, // Rio de Janeiro
                'school_id' => 2, // Colégio Batista
                'whatsapp' => '21999990006',
                'instagram' => '@ana.beatriz',
            ],

            [
                'name' => 'Tales Brandao',
                'email' => 'tales@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 2, // Brasília
                'school_id' => 4, // CMB
                'whatsapp' => '61999990003',
                'instagram' => '@tales.brandao',
            ],

        ];

        foreach ($users as $user) {

            User::firstOrCreate(

                [
                    'email' => $user['email'],
                ],

                $user
            );
        }
    }
}
