<?php

namespace App\Services;

class BookMetadataService
{
    public function __construct(
        protected GoogleBooksService $googleBooksService,
        protected OpenLibraryService $openLibraryService,
    ) {}

    public function searchByIsbn(string $isbn): ?array
    {
        $book = $this->openLibraryService
            ->searchByIsbn($isbn);

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