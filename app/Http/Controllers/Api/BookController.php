<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $query->available();

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

            $query->forTrade();
        }

        if ($request->accept_sale) {

            $query->forSale();
        }

        if ($request->accept_donation) {

            $query->forDonation();
        }

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'title',
                    'like',
                    '%'.$request->search.'%'
                )
                    ->orWhere(
                        'author',
                        'like',
                        '%'.$request->search.'%'
                    )
                    ->orWhere(
                        'publisher',
                        'like',
                        '%'.$request->search.'%'
                    );
            });
        }

        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        return BookResource::collection(
            $query
                ->paginate(

                    min(
                        $request->get('page_size', 10),
                        100
                    )
                )

        );
    }

    public function store(StoreBookRequest $request)
    {

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

        return new BookResource($book);
    }

    public function show(Book $book)
    {
        $book->load([
            'user',
            'subject',
            'user.city',
            'user.school',
        ]);

        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        if ($book->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Sem permissão',
            ], 403);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($book->image) {

                Storage::disk('public')
                    ->delete($book->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('books', 'public');
        }

        $book->update($data);

        $book->load([
            'user',
            'subject',
            'user.city',
            'user.school',
        ]);

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        if ($book->user_id != auth()->id()) {

            return response()->json([
                'message' => 'Sem permissão',
            ], 403);
        }

        if ($book->image) {

            Storage::disk('public')
                ->delete($book->image);
        }

        $book->delete();

        return response()->json([
            'message' => 'Livro removido',
        ]);
    }
}
