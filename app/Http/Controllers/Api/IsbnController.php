<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookMetadataService;
use Illuminate\Http\JsonResponse;

class IsbnController extends Controller
{
    public function __construct(
        protected BookMetadataService $bookMetadataService
    ) {}

    public function show(string $isbn): JsonResponse
    {
        $book = $this->bookMetadataService
            ->searchByIsbn($isbn);

        if (! $book) {

            return response()->json([
                'message' => 'ISBN não encontrado.',
            ], 404);
        }

        return response()->json([
            'data' => $book,
        ]);
    }
}
