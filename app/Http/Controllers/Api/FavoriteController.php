<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $books = $request->user()
            ->favoriteBooks()
            ->with([
                'user.city.state',
                'user.school',
                'subject',
                'grade'
            ])
            ->latest()
            ->paginate(10);

        return BookResource::collection($books);
    }

    public function store(
        Request $request,
        Book $book
    ) {
        $request->user()
            ->favoriteBooks()
            ->syncWithoutDetaching([
                $book->id
            ]);

        return response()->json([
            'message' =>
                'Livro adicionado aos favoritos'
        ]);
    }

    public function destroy(
        Request $request,
        Book $book
    ) {
        $request->user()
            ->favoriteBooks()
            ->detach($book->id);

        return response()->json([
            'message' =>
                'Livro removido dos favoritos'
        ]);
    }
}
