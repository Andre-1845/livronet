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
                'city_id' => 3689, // Rio de Janeiro
                'school_id' => 41, // IFRJ
                'whatsapp' => '24999990001',
                'instagram' => '@joao.silva',
            ],

            [
                'name' => 'Mario Gomes',
                'email' => 'mario@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 3689, // Rio de Janeiro
                'school_id' => 12, // CMRJ
                'whatsapp' => '62999990002',
                'instagram' => '@mario.gomes',
            ],

            [
                'name' => 'Luciana Alves',
                'email' => 'luciana@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 3689, // Rio de Janeiro
                'school_id' => 12, // CMRJ
                'whatsapp' => '61999990003',
                'instagram' => '@luciana.alves',
            ],

            [
                'name' => 'Fernanda Costa',
                'email' => 'fernanda@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' =>806, // Brasilia
                'school_id' => 3, // CMB
                'whatsapp' => '61999990004',
                'instagram' => '@fernanda.costa',
            ],

            [
                'name' => 'Carlos Pereira',
                'email' => 'carlos@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 806, // Brasilia
                'school_id' => 3, // CMB
                'whatsapp' => '24999990005',
                'instagram' => '@carlos.pereira',
            ],

            [
                'name' => 'Ana Beatriz Souza',
                'email' => 'ana@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 3316, // Curitiba
                'school_id' => 5, // CMC
                'whatsapp' => '21999990006',
                'instagram' => '@ana.beatriz',
            ],

            [
                'name' => 'Tales Brandao',
                'email' => 'tales@livronet.com',
                'password' => Hash::make('123456'),
                'city_id' => 1799, // Juiz de Fora
                'school_id' => 8, // CMJF
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
