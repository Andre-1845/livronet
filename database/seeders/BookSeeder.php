<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [

            // ==================================================
            // USUÁRIO 1 - JOAO
            // ==================================================

            [
                'user_id' => 1,
                'subject_id' => 15, // Matemática
                'grade_id' => 14,
                'title' => 'Matemática Básica',
                'author' => 'Iezzi',
                'publisher' => 'Atual',
                'edition' => '8ª',
                'isbn' => '978850000001',
                'price' => 35.50,
                'accept_sale' => true,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Livro em ótimo estado.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 8, // Física
                'grade_id' => 16,
                'title' => 'Física para Vestibular',
                'author' => 'Ramalho',
                'publisher' => 'Saraiva',
                'edition' => '12ª',
                'isbn' => '978850000002',
                'price' => 80.00,
                'accept_sale' => true,
                'accept_trade' => false,
                'accept_donation' => false,
                'description' => 'Excelente conservação.',
                'is_available' => true,
            ],

            [
                'user_id' => 1,
                'subject_id' => 18, // Química
                'grade_id' => 15,
                'title' => 'Química na Prática',
                'author' => 'Peruzzo',
                'publisher' => 'FTD',
                'edition' => '4ª',
                'isbn' => '978850000003',
                'price' => 45.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Leves desgastes.',
                'is_available' => true,
            ],

            // ==================================================
            // USUÁRIO 2 - MARIO
            // ==================================================

            [
                'user_id' => 2,
                'subject_id' => 11, // História
                'grade_id' => 16,
                'title' => 'História Geral',
                'author' => 'Vicentino',
                'publisher' => 'Scipione',
                'edition' => '5ª',
                'isbn' => '978850000004',
                'price' => 40.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => true,
                'description' => 'Com algumas marcas.',
                'is_available' => true,
            ],

            [
                'user_id' => 2,
                'subject_id' => 10, // Geografia
                'grade_id' => 15,
                'title' => 'Geografia Atual',
                'author' => 'Moreira',
                'publisher' => 'Moderna',
                'edition' => '7ª',
                'isbn' => '978850000005',
                'price' => 50.00,
                'accept_sale' => true,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Livro seminovo.',
                'is_available' => true,
            ],

            [
                'user_id' => 2,
                'subject_id' => 20, // Sociologia
                'grade_id' => 16,
                'title' => 'Sociologia Moderna',
                'author' => 'Tomazi',
                'publisher' => 'Saraiva',
                'edition' => '3ª',
                'isbn' => '978850000006',
                'price' => 30.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Bom estado.',
                'is_available' => true,
            ],

            // ==================================================
            // USUÁRIO 3 - LUCIANA
            // ==================================================

            [
                'user_id' => 3,
                'subject_id' => 19, // Redação
                'grade_id' => 16,
                'title' => 'Redação Nota 1000',
                'author' => 'Fernanda Pessoa',
                'publisher' => 'FTD',
                'edition' => '2ª',
                'isbn' => '978850000007',
                'price' => 65.00,
                'accept_sale' => true,
                'accept_trade' => false,
                'accept_donation' => false,
                'description' => 'Excelente para ENEM.',
                'is_available' => true,
            ],

            [
                'user_id' => 3,
                'subject_id' => 14, // Literatura
                'grade_id' => 1,
                'title' => 'Literatura Brasileira',
                'author' => 'Antonio Candido',
                'publisher' => 'Ática',
                'edition' => '9ª',
                'isbn' => '978850000008',
                'price' => 30.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => true,
                'description' => 'Livro antigo.',
                'is_available' => true,
            ],

            [
                'user_id' => 3,
                'subject_id' => 7, // Filosofia
                'grade_id' => 15,
                'title' => 'Filosofia Essencial',
                'author' => 'Marilena Chauí',
                'publisher' => 'Ática',
                'edition' => '6ª',
                'isbn' => '978850000009',
                'price' => 25.00,
                'accept_sale' => false,
                'accept_trade' => false,
                'accept_donation' => true,
                'description' => 'Bem conservado.',
                'is_available' => true,
            ],

            // ==================================================
            // USUÁRIO 4 - FERNANDA
            // ==================================================

            [
                'user_id' => 4,
                'subject_id' => 2, // Biologia
                'grade_id' => 14,
                'title' => 'Biologia Moderna',
                'author' => 'Amabis',
                'publisher' => 'Moderna',
                'edition' => '6ª',
                'isbn' => '978850000010',
                'price' => 55.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Muito conservado.',
                'is_available' => true,
            ],

            [
                'user_id' => 4,
                'subject_id' => 3, // Ciências
                'grade_id' => 10,
                'title' => 'Ciências para Todos',
                'author' => 'Carlos Barros',
                'publisher' => 'FTD',
                'edition' => '4ª',
                'isbn' => '978850000011',
                'price' => 20.00,
                'accept_sale' => true,
                'accept_trade' => false,
                'accept_donation' => false,
                'description' => 'Ideal para ensino fundamental.',
                'is_available' => true,
            ],

            [
                'user_id' => 4,
                'subject_id' => 5, // Educação Física
                'grade_id' => 14,
                'title' => 'Educação Física Escolar',
                'author' => 'João Batista Freire',
                'publisher' => 'Papirus',
                'edition' => '3ª',
                'isbn' => '978850000012',
                'price' => 18.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => true,
                'description' => 'Pouco utilizado.',
                'is_available' => true,
            ],

            // ==================================================
            // USUÁRIO 5 - CARLOS
            // ==================================================

            [
                'user_id' => 5,
                'subject_id' => 13, // Inglês
                'grade_id' => 2,
                'title' => 'English Grammar',
                'author' => 'Murphy',
                'publisher' => 'Cambridge',
                'edition' => '3ª',
                'isbn' => '978850000013',
                'price' => 70.00,
                'accept_sale' => true,
                'accept_trade' => false,
                'accept_donation' => false,
                'description' => 'Importado.',
                'is_available' => true,
            ],

            [
                'user_id' => 5,
                'subject_id' => 9, // Francês
                'grade_id' => 2,
                'title' => 'Francês Moderno',
                'author' => 'Pierre Dubois',
                'publisher' => 'Larousse',
                'edition' => '2ª',
                'isbn' => '978850000014',
                'price' => 45.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Ótimo para iniciantes.',
                'is_available' => true,
            ],

            [
                'user_id' => 5,
                'subject_id' => 6, // Espanhol
                'grade_id' => 2,
                'title' => 'Espanhol para Iniciantes',
                'author' => 'Maria Garcia',
                'publisher' => 'Moderna',
                'edition' => '1ª',
                'isbn' => '978850000015',
                'price' => 35.00,
                'accept_sale' => false,
                'accept_trade' => true,
                'accept_donation' => true,
                'description' => 'Material didático completo.',
                'is_available' => true,
            ],

            // ==================================================
            // USUÁRIO 6 - ANA
            // ==================================================

            [
                'user_id' => 6,
                'subject_id' => 12, // Informática
                'grade_id' => 4,
                'title' => 'Introdução à Informática',
                'author' => 'Marcos Veloso',
                'publisher' => 'Novatec',
                'edition' => '5ª',
                'isbn' => '978850000016',
                'price' => 55.00,
                'accept_sale' => true,
                'accept_trade' => true,
                'accept_donation' => false,
                'description' => 'Excelente para iniciantes.',
                'is_available' => true,
            ],

            [
                'user_id' => 6,
                'subject_id' => 16, // Música
                'grade_id' => 1,
                'title' => 'Música e Arte',
                'author' => 'Carlos Gomes',
                'publisher' => 'Ática',
                'edition' => '2ª',
                'isbn' => '978850000017',
                'price' => 25.00,
                'accept_sale' => false,
                'accept_trade' => false,
                'accept_donation' => true,
                'description' => 'Livro de apoio cultural.',
                'is_available' => true,
            ],

            [
                'user_id' => 6,
                'subject_id' => 4, // Desenho
                'grade_id' => 15,
                'title' => 'Desenho Técnico',
                'author' => 'José Carlos',
                'publisher' => 'Érica',
                'edition' => '4ª',
                'isbn' => '978850000018',
                'price' => 40.00,
                'accept_sale' => true,
                'accept_trade' => false,
                'accept_donation' => false,
                'description' => 'Muito útil para cursos técnicos.',
                'is_available' => true,
            ],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                [
                    'isbn' => $book['isbn'],
                ],
                $book
            );
        }
    }
}
