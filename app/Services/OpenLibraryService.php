<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenLibraryService
{
    private const TIMEOUT = 5;

    public function searchByIsbn(string $isbn): ?array
    {
        $isbn = preg_replace('/[^0-9X]/i', '', $isbn);

        $book = $this->safeGet(
            "https://openlibrary.org/isbn/{$isbn}.json"
        );

        if (! $book) {
            return null;
        }

        return [
            'isbn' => $isbn,
            'title' => $book['title'] ?? null,
            'author' => $this->getAuthorFromWork($book),
            'publisher' => $this->extractPublisher($book),
            'published_date' => $book['publish_date'] ?? null,
            'edition' => null,
            'cover_url' => $this->extractCoverUrl($book),
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

        $work = $this->safeGet(
            'https://openlibrary.org'.
            $book['works'][0]['key'].
            '.json'
        );

        if (! $work) {
            return null;
        }

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

            $author = $this->safeGet(
                'https://openlibrary.org'.
                $authorKey.
                '.json'
            );

            if (! $author) {
                continue;
            }

            if (! empty($author['name'])) {
                $authors[] = $author['name'];
            }
        }

        return empty($authors)
            ? null
            : implode(', ', $authors);
    }

    private function extractPublisher(array $book): ?string
    {
        if (
            isset($book['publishers']) &&
            is_array($book['publishers']) &&
            ! empty($book['publishers'])
        ) {
            return $book['publishers'][0];
        }

        return null;
    }

    private function extractCoverUrl(array $book): ?string
    {
        if (
            isset($book['covers']) &&
            is_array($book['covers']) &&
            ! empty($book['covers'])
        ) {
            return
                'https://covers.openlibrary.org/b/id/'.
                $book['covers'][0].
                '-L.jpg';
        }

        return null;
    }

    private function safeGet(string $url): ?array
    {
        try {

            $response = Http::timeout(self::TIMEOUT)
                ->acceptJson()
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            return $response->json();

        } catch (\Throwable $e) {

            Log::warning(
                'OpenLibrary request failed',
                [
                    'url' => $url,
                    'message' => $e->getMessage(),
                ]
            );

            return null;
        }
    }
}
