<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class BookMetadataService
{
    public function __construct(
        protected GoogleBooksService $googleBooksService,
        protected OpenLibraryService $openLibraryService,
    ) {}

    public function searchByIsbn(string $isbn): ?array
    {
        $start = microtime(true);
        Log::info('[ISBN] OpenLibrary START');
        $book = $this->openLibraryService
            ->searchByIsbn($isbn);

        Log::info(
            '[ISBN] OpenLibrary END',
            [
                'tempo_ms' => round(
                    (microtime(true) - $start) * 1000
                ),
            ]
        );

        if ($book) {
            return $book;
        }

        $book = $this->googleBooksService
            ->searchByIsbn($isbn);

        if ($book) {
            return $book;
        }

        return null;
    }
}
