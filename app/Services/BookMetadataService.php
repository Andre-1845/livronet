<?php

namespace App\Services;

class BookMetadataService
{
    public function __construct(
        protected OpenLibraryService $openLibraryService,
        protected GoogleBooksService $googleBooksService,
    ) {}

    public function searchByIsbn(string $isbn): ?array
    {
        $book = $this->openLibraryService
            ->searchByIsbn($isbn);

        if ($book) {
            return $book;
        }

        return $this->googleBooksService
            ->searchByIsbn($isbn);
    }
}
