<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenLibraryService
{
    public function searchByIsbn(string $isbn): ?array
    {
        $isbn = preg_replace('/[^0-9X]/i', '', $isbn);

        $response = Http::timeout(10)
            ->get("https://openlibrary.org/isbn/{$isbn}.json");

        if (! $response->successful()) {
            return null;
        }

        $book = $response->json();

        $author = $this->getAuthorFromWork($book);

        $publisher = null;

        if (
            isset($book['publishers']) &&
            is_array($book['publishers']) &&
            count($book['publishers']) > 0
        ) {
            $publisher = $book['publishers'][0];
        }

        $coverUrl = null;

        if (
            isset($book['covers']) &&
            is_array($book['covers']) &&
            count($book['covers']) > 0
        ) {
            $coverUrl =
                'https://covers.openlibrary.org/b/id/'.
                $book['covers'][0].
                '-L.jpg';
        }

        return [
            'isbn' => $isbn,
            'title' => $book['title'] ?? null,
            'author' => $author,
            'publisher' => $publisher,
            'published_date' => $book['publish_date'] ?? null,
            'edition' => null,
            'cover_url' => $coverUrl,
            'source' => 'openlibrary',
        ];
    }

    private function getAuthorFromWork(array $book): ?string
    {
        if (
            ! isset($book['works']) ||
            empty($book['works'][0]['key'])
        ) {
            return null;
        }

        $workResponse = Http::timeout(10)
            ->get(
                'https://openlibrary.org'.
                $book['works'][0]['key'].
                '.json'
            );

        if (! $workResponse->successful()) {
            return null;
        }

        $work = $workResponse->json();

        if (
            ! isset($work['authors']) ||
            empty($work['authors'])
        ) {
            return null;
        }

        $authors = [];

        foreach ($work['authors'] as $authorData) {

            $authorKey =
                $authorData['author']['key'] ?? null;

            if (! $authorKey) {
                continue;
            }

            $authorResponse = Http::timeout(10)
                ->get(
                    'https://openlibrary.org'.
                    $authorKey.
                    '.json'
                );

            if (! $authorResponse->successful()) {
                continue;
            }

            $authorJson = $authorResponse->json();

            if (! empty($authorJson['name'])) {
                $authors[] = $authorJson['name'];
            }
        }

        return empty($authors)
            ? null
            : implode(', ', $authors);
    }
}
