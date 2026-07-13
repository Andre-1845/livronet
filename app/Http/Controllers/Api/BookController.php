<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\IsbnCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with([
            'user',
            'subject',
            'grade',
            'user.city',
            'user.school',
            'favoritedBy',
        ]);
        $query->available();

        if ($request->subject_id) {

            $query->where('subject_id', $request->subject_id);
        }

        if ($request->grade_id) {

            $query->where('grade_id', $request->grade_id);
        }

        if ($request->state_id) {

            $query->whereHas('user.city', function ($q) use ($request) {

                $q->where('state_id', $request->state_id);
            });
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

        $pageSize = min(
            $request->query('page_size', 15),
            100
        );

        return BookResource::collection(
            $query->paginate($pageSize)
        );
    }

    public function store(StoreBookRequest $request)
    {

        $imagePath = null;

        /*
        |--------------------------------------------------------------------------
        | 1 - IMAGEM ENVIADA PELO USUÁRIO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('books', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | 2 - CAPA AUTOMÁTICA VIA ISBN CATALOG
        |--------------------------------------------------------------------------
        */

        elseif (! empty($request->isbn)) {

            $catalog = IsbnCatalog::where(
                'isbn',
                $request->isbn
            )->first();

            if ($catalog) {

                /*
                |--------------------------------------------------------------------------
                | 2.1 - REUTILIZA CAPA LOCAL
                |--------------------------------------------------------------------------
                */

                if (
                    ! empty($catalog->local_cover_path)
                    && Storage::disk('public')->exists(
                        $catalog->local_cover_path
                    )
                ) {

                    $extension = pathinfo(
                        $catalog->local_cover_path,
                        PATHINFO_EXTENSION
                    );

                    $newFile =
                        'books/'.
                        Str::uuid().
                        '.'.
                        $extension;

                    Storage::disk('public')->copy(
                        $catalog->local_cover_path,
                        $newFile
                    );

                    $imagePath = $newFile;

                    Log::info(
                        '[ISBN COVER] Reutilizando capa local',
                        [
                            'isbn' => $request->isbn,
                        ]
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | 2.2 - DOWNLOAD DA CAPA
                |--------------------------------------------------------------------------
                */

                elseif (! empty($catalog->cover_url)) {

                    try {

                        Log::info(
                            '[ISBN COVER] Download iniciado',
                            [
                                'isbn' => $request->isbn,
                            ]
                        );

                        $response = Http::timeout(15)
                            ->get($catalog->cover_url);

                        if ($response->successful()) {

                            $catalogFile =
                                'books/catalog/'.
                                Str::uuid().
                                '.jpg';

                            Storage::disk('public')->put(
                                $catalogFile,
                                $response->body()
                            );

                            $catalog->update([
                                'local_cover_path' => $catalogFile,
                            ]);

                            $newFile =
                                'books/'.
                                Str::uuid().
                                '.jpg';

                            Storage::disk('public')->copy(
                                $catalogFile,
                                $newFile
                            );

                            $imagePath = $newFile;

                            Log::info(
                                '[ISBN COVER] Download concluído',
                                [
                                    'isbn' => $request->isbn,
                                    'catalog_file' => $catalogFile,
                                ]
                            );
                        }
                    } catch (\Throwable $e) {

                        Log::warning(
                            '[ISBN COVER] Falha download',
                            [
                                'isbn' => $request->isbn,
                                'erro' => $e->getMessage(),
                            ]
                        );
                    }
                }
            }
        }

        $book = Book::create([

            'user_id' => auth()->id(),

            'subject_id' => $request->subject_id,

            'title' => $request->title,

            'author' => $request->author,

            'publisher' => $request->publisher,

            'edition' => $request->edition,

            'image' => $imagePath,

            'grade_id' => $request->grade_id,

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
            'grade',
            'user.city',
            'user.school',
            'favoritedBy',
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
            'grade',
            'user.city',
            'user.school',
            'favoritedBy',
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

        // Soft delete: a imagem NÃO é apagada aqui de propósito, para que
        // conversas antigas sobre este livro continuem exibindo a capa.
        // A imagem só é removida de fato quando o registro é limpo
        // definitivamente (ver comando books:purge-trashed).
        $book->update(['is_available' => false]);

        $book->delete();

        return response()->json([
            'message' => 'Livro removido',
        ]);
    }

    public function myBooks()
    {
        $books = Book::with([
            'user',
            'subject',
            'grade',
            'user.city',
            'user.school',
            'favoritedBy',
        ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->paginate(10);

        return BookResource::collection(
            $books
        );
    }
}
