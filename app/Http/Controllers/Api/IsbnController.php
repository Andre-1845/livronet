<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookMetadataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class IsbnController extends Controller
{
    public function __construct(
        protected BookMetadataService $bookMetadataService
    ) {}

    public function show(string $isbn): JsonResponse
    {

file_put_contents(
    storage_path('logs/isbn_trace.log'),
    now() . ' ISBN=' . $isbn . PHP_EOL,
    FILE_APPEND
);

        Log::info(
            '[ISBN] Consulta iniciada',
            ['isbn' => $isbn]
        );
        $book = $this->bookMetadataService
            ->searchByIsbn($isbn);

        if (! $book) {

            return response()->json([
                'message' => 'ISBN não encontrado.',
            ], 404);
        }
        Log::info(
            '[ISBN] Consulta concluida',
            ['isbn' => $isbn]
        );

        return response()->json([
            'data' => $book,
        ]);
    }
}