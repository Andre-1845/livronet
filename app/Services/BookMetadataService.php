<?php

namespace App\Services;

use App\Models\IsbnCatalog;
use Illuminate\Support\Facades\Log;

class BookMetadataService
{
    public function __construct(
        protected GoogleBooksService $googleBooksService,
        protected OpenLibraryService $openLibraryService,
    ) {}

    public function searchByIsbn(string $isbn): ?array
    {
        $isbn = preg_replace(
            '/[^0-9X]/i',
            '',
            $isbn
        );

        /*
        |--------------------------------------------------------------------------
        | 1 - CONSULTA CATÁLOGO LOCAL
        |--------------------------------------------------------------------------
        */

        $catalog = IsbnCatalog::where(
            'isbn',
            $isbn
        )->first();

        if ($catalog) {

            Log::info(
                '[ISBN] Catalog HIT',
                [
                    'isbn' => $isbn,
                    'lookup_count' => $catalog->lookup_count + 1,
                ]
            );

            $catalog->increment(
                'lookup_count'
            );

            $catalog->update([
                'last_lookup_at' => now(),
            ]);

            return [
                'isbn' => $catalog->isbn,
                'title' => $catalog->title,
                'author' => $catalog->author,
                'publisher' => $catalog->publisher,
                'published_date' => $catalog->published_date,
                'edition' => $catalog->edition,
                'cover_url' => $catalog->cover_url,
                'source' => $catalog->source,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 2 - OPENLIBRARY
        |--------------------------------------------------------------------------
        */

        $start = microtime(true);

        Log::info(
            '[ISBN] OpenLibrary START'
        );

        $book = $this->openLibraryService
            ->searchByIsbn($isbn);

        Log::info(
            '[ISBN] OpenLibrary END',
            [
                'tempo_ms' => round(
                    (
                        microtime(true)
                        - $start
                    ) * 1000
                ),
            ]
        );

        if ($book) {

            $this->storeCatalog(
                $book
            );

            return $book;
        }

        /*
        |--------------------------------------------------------------------------
        | 3 - GOOGLE BOOKS
        |--------------------------------------------------------------------------
        */

        Log::info(
            '[ISBN] GoogleBooks START'
        );

        $book = $this->googleBooksService
            ->searchByIsbn($isbn);

        Log::info(
            '[ISBN] GoogleBooks END'
        );

        if ($book) {

            $this->storeCatalog(
                $book
            );

            return $book;
        }

        return null;
    }

    private function storeCatalog(
        array $book
    ): void {

        IsbnCatalog::updateOrCreate(

            [
                'isbn' => $book['isbn'],
            ],

            [

                'title' => $book['title'] ?? null,

                'author' => $book['author'] ?? null,

                'publisher' => $book['publisher'] ?? null,

                'published_date' => $book['published_date']
                    ?? null,

                'edition' => $book['edition']
                    ?? null,

                'cover_url' => $book['cover_url']
                    ?? null,

                'source' => $book['source']
                    ?? null,

                'subjects' => null,

                'lookup_count' => 1,

                'last_lookup_at' => now(),

                'last_api_refresh_at' => now(),

                'api_response_hash' => md5(
                    json_encode(
                        $book
                    )
                ),

                'is_active' => true,
            ]
        );
    }
}
