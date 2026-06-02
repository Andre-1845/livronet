<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with([
            'user',
            'subject',
            'user.city',
            'user.school',
        ]);

        if ($request->subject_id) {

            $query->where('subject_id', $request->subject_id);
        }

        if ($request->city_id) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('city_id', $request->city_id);
            });
        }

        if ($request->school_id) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where('school_id', $request->school_id);
            });
        }

        if ($request->accept_trade) {

            $query->where('accept_trade', true);
        }

        if ($request->accept_sale) {

            $query->where('accept_sale', true);
        }

        if ($request->accept_donation) {

            $query->where('accept_donation', true);
        }

        return $query
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',

            'author' => 'required',

            'subject_id' => 'required',

            'image' => 'nullable|image|max:2048',

        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('books', 'public');
        }

        $book = Book::create([

            'user_id' => auth()->id(),

            'subject_id' => $request->subject_id,

            'title' => $request->title,

            'author' => $request->author,

            'publisher' => $request->publisher,

            'edition' => $request->edition,

            'image' => $imagePath,

            'school_grade' => $request->school_grade,

            'isbn' => $request->isbn,

            'price' => $request->price,

            'accept_trade' => $request->accept_trade ?? false,

            'accept_sale' => $request->accept_sale ?? false,

            'accept_donation' => $request->accept_donation ?? false,

            'description' => $request->description,

            'is_available' => true,
        ]);

        return response()->json($book);
    }

    public function show(Book $book)
    {
        return $book->load([
            'user',
            'subject',
            'user.city',
            'user.school',
        ]);
    }

    public function update(Request $request, Book $book)
    {
        if ($book->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Sem permissão',
            ], 403);
        }

        $book->update($request->all());

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        if ($book->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Sem permissão',
            ], 403);
        }

        $book->delete();

        return response()->json([
            'message' => 'Livro removido',
        ]);
    }
}
