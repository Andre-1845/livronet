<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleBooksService
{
    private const TIMEOUT = 10;

    public function searchByIsbn(string $isbn): ?array
    {
        $isbn = preg_replace('/[^0-9X]/i', '', $isbn);

        try {

            $response = Http::timeout(self::TIMEOUT)
                ->acceptJson()
                ->get(
                    'https://www.googleapis.com/books/v1/volumes',
                    [
                        'q' => 'isbn:'.$isbn,
                    ]
                );

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();
            Log::info(
                '[ISBN] GoogleBooks RESULT',
                [
                    'isbn' => $isbn,
                    'status' => $response->status(),
                    'totalItems' => $data['totalItems'] ?? 0,
                ]
            );
            if (
                ! isset($data['items']) ||
                empty($data['items'])
            ) {
                return null;
            }

            $item = $data['items'][0];
            $volume = $item['volumeInfo'] ?? [];

            return [
                'isbn' => $isbn,
                'google_books_id' => $item['id'] ?? null,
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

        } catch (\Throwable $e) {

            Log::warning(
                'Google Books request failed',
                [
                    'isbn' => $isbn,
                    'message' => $e->getMessage(),
                ]
            );

            return null;
        }
    }
}
