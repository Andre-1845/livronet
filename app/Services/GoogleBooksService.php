<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleBooksService
{
    public function searchByIsbn(string $isbn): ?array
    {
        $isbn = preg_replace('/[^0-9X]/i', '', $isbn);

        $response = Http::timeout(10)->get(
            'https://www.googleapis.com/books/v1/volumes',
            [
                'q' => 'isbn:'.$isbn,
            ]
        );

        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();

        if (
            ! isset($data['items']) ||
            empty($data['items'])
        ) {
            return null;
        }

        $volume = $data['items'][0]['volumeInfo'] ?? [];

        return [
            'isbn' => $isbn,

            'google_books_id' => $data['items'][0]['id'] ?? null,

            'title' => $volume['title'] ?? null,

            'author' => isset($volume['authors'])
                    ? implode(', ', $volume['authors'])
                    : null,

            'publisher' => $volume['publisher'] ?? null,

            'published_date' => $volume['publishedDate'] ?? null,

            'edition' => null,

            'cover_url' => $volume['imageLinks']['thumbnail']
                ?? $volume['imageLinks']['smallThumbnail']
                ?? null,

            'source' => 'google_books',
        ];
    }
}
