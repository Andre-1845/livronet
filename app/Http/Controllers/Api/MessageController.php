<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Lista as conversas do usuário.
     */
    public function index(Request $request)
{
    $userId = auth()->id();

    $messages = Message::with([
        'sender',
        'receiver',
        'book',
    ])
    ->where(function ($query) use ($userId) {

        $query->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);

    })
    ->latest()
    ->get();

    $conversations = [];

    foreach ($messages as $message) {

        $otherUser = $message->sender_id == $userId
            ? $message->receiver
            : $message->sender;

        $conversationKey =
            $message->book_id . '_' . $otherUser->id;

        if (!isset($conversations[$conversationKey])) {

            $conversations[$conversationKey] = [

                'book_id' => $message->book_id,

                'book_title' => $message->book?->title,

                'other_user_id' => $otherUser->id,

                'other_user_name' => $otherUser->name,

                'last_message' => $message->message,

                'last_message_at' => $message->created_at,
            ];
        }
    }

    return ConversationResource::collection(
        collect($conversations)->values()
    );
}

    /**
     * Retorna uma conversa específica.
     */
    public function show(
        int $bookId,
        int $userId
    ) {

        $messages = Message::with([
            'sender',
            'receiver',
        ])
            ->where('book_id', $bookId)
            ->where(function ($query) use ($userId) {

                $query->where(function ($q) use ($userId) {

                    $q->where(
                        'sender_id',
                        auth()->id()
                    )
                        ->where(
                            'receiver_id',
                            $userId
                        );

                })
                    ->orWhere(function ($q) use ($userId) {

                        $q->where(
                            'sender_id',
                            $userId
                        )
                            ->where(
                                'receiver_id',
                                auth()->id()
                            );

                    });

            })
            ->orderBy('created_at')
            ->get();

        return MessageResource::collection(
            $messages
        );
    }

    /**
     * Envia mensagem.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'receiver_id' => [
                'required',
                'exists:users,id',
            ],

            'book_id' => [
                'required',
                'exists:books,id',
            ],

            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $message = Message::create([

            'sender_id' => auth()->id(),

            'receiver_id' => $validated['receiver_id'],

            'book_id' => $validated['book_id'],

            'message' => trim(
                $validated['message']
            ),
        ]);

        $message->load([
            'sender',
            'receiver',
        ]);

        return new MessageResource(
            $message
        );
    }
}
