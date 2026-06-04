<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [

            [
                'user_id' => 1,
                'subject_id' => 1,
                'title' => 'Matemática Básica',
                'author' => 'Iezzi',
                'publisher' => 'Atual',
                'edition' => '8ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000001',
                'price' => 35.50,
                'accept_trade' => true,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Livro em ótimo estado.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 2,
                'title' => 'Português Completo',
                'author' => 'Cereja',
                'publisher' => 'Atual',
                'edition' => '10ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000002',
                'price' => 60.00,
                'accept_trade' => false,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Pouco usado.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 3,
                'title' => 'História Geral',
                'author' => 'Vicentino',
                'publisher' => 'Scipione',
                'edition' => '5ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000003',
                'price' => 40.00,
                'accept_trade' => true,
                'accept_sale' => false,
                'accept_donation' => true,
                'description' => 'Com algumas marcas.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 4,
                'title' => 'Geografia Atual',
                'author' => 'Moreira',
                'publisher' => 'Moderna',
                'edition' => '7ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000004',
                'price' => 50.00,
                'accept_trade' => true,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Livro seminovo.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 5,
                'title' => 'Física para Vestibular',
                'author' => 'Ramalho',
                'publisher' => 'Saraiva',
                'edition' => '12ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000005',
                'price' => 80.00,
                'accept_trade' => false,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Excelente conservação.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 6,
                'title' => 'Química na Prática',
                'author' => 'Peruzzo',
                'publisher' => 'FTD',
                'edition' => '4ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000006',
                'price' => 45.00,
                'accept_trade' => true,
                'accept_sale' => true,
                'accept_donation' => true,
                'description' => 'Leves desgastes.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 7,
                'title' => 'Biologia Moderna',
                'author' => 'Amabis',
                'publisher' => 'Moderna',
                'edition' => '6ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000007',
                'price' => 55.00,
                'accept_trade' => true,
                'accept_sale' => false,
                'accept_donation' => false,
                'description' => 'Muito conservado.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 9,
                'title' => 'English Grammar',
                'author' => 'Murphy',
                'publisher' => 'Cambridge',
                'edition' => '3ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000008',
                'price' => 70.00,
                'accept_trade' => false,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Importado.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 14,
                'title' => 'Literatura Brasileira',
                'author' => 'Cândido',
                'publisher' => 'Ática',
                'edition' => '9ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000009',
                'price' => 30.00,
                'accept_trade' => true,
                'accept_sale' => true,
                'accept_donation' => true,
                'description' => 'Livro antigo.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 15,
                'title' => 'Redação Nota 1000',
                'author' => 'Fernanda Pessoa',
                'publisher' => 'FTD',
                'edition' => '2ª',
                'school_grade' => 'Ensino Médio',
                'isbn' => '978850000010',
                'price' => 65.00,
                'accept_trade' => false,
                'accept_sale' => true,
                'accept_donation' => false,
                'description' => 'Excelente para ENEM.',
                'is_available' => true,
            ],

        ];

        foreach ($books as $book) {

            Book::firstOrCreate($book);
        }
    }
}