<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Lista as conversas do usuário logado.
     */
    public function index(Request $request)
    {
        $userId = auth()->id();

        $conversations = Conversation::with([
            'book',
            'userOne',
            'userTwo',

        ])
            ->where(function ($query) use ($userId) {

                $query->where(function ($q) use ($userId) {

                    $q->where('user_one_id', $userId)
                        ->where('hidden_by_user_one', false);

                })->orWhere(function ($q) use ($userId) {

                    $q->where('user_two_id', $userId)
                        ->where('hidden_by_user_two', false);

                });

            })
            ->orderByDesc('last_message_at')
            ->get();

        return ConversationResource::collection(
            $conversations
        );
    }

    /**
     * Abre uma conversa.
     */
    public function show(
        Conversation $conversation
    ) {

        $userId = auth()->id();

        abort_unless(

            $conversation->user_one_id === $userId ||
            $conversation->user_two_id === $userId,

            403
        );

        $conversation->messages()
            ->where('receiver_id', $userId)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        $messages = $conversation->messages()
            ->with([
                'sender',
                'receiver',
            ])
            ->orderBy('created_at')
            ->get();

        return MessageResource::collection(
            $messages
        );
    }

    /**
     * Oculta uma conversa para o usuário logado.
     */
    public function destroy(
        Conversation $conversation
    ) {

        $userId = auth()->id();

        abort_unless(

            $conversation->user_one_id === $userId ||
            $conversation->user_two_id === $userId,

            403
        );

        if ($conversation->user_one_id === $userId) {

            $conversation->update([
                'hidden_by_user_one' => true,
            ]);
        }

        if ($conversation->user_two_id === $userId) {

            $conversation->update([
                'hidden_by_user_two' => true,
            ]);
        }

        return response()->json([
            'message' => 'Conversa ocultada com sucesso.',
        ]);
    }

    /**
     * Cria ou recupera uma conversa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'book_id' => [
                'required',
                'exists:books,id',
            ],

            'receiver_id' => [
                'required',
                'exists:users,id',
            ],
        ]);

        $senderId = auth()->id();

        if ($senderId == $validated['receiver_id']) {

            return response()->json([
                'message' => 'Não é possível conversar consigo mesmo.',
            ], 422);
        }

        $userOne = min(
            $senderId,
            $validated['receiver_id']
        );

        $userTwo = max(
            $senderId,
            $validated['receiver_id']
        );

        $conversation = Conversation::where(
            'book_id',
            $validated['book_id']
        )
            ->where('user_one_id', $userOne)
            ->where('user_two_id', $userTwo)
            ->first();

        if (! $conversation) {

            $conversation = Conversation::create([

                'book_id' => $validated['book_id'],

                'user_one_id' => $userOne,

                'user_two_id' => $userTwo,

                'last_message_at' => null,
            ]);
        }

        if (
            $conversation->user_one_id === $senderId
        ) {

            $conversation->update([
                'hidden_by_user_one' => false,
            ]);
        }

        if (
            $conversation->user_two_id === $senderId
        ) {

            $conversation->update([
                'hidden_by_user_two' => false,
            ]);
        }

        $conversation->load([
            'book',
            'userOne',
            'userTwo',
        ]);

        return new ConversationResource(
            $conversation
        );
    }
}
