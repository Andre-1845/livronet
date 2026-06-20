<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Envia uma mensagem para uma conversa.
     */
    public function store(
        Request $request,
        Conversation $conversation
    ) {

        $userId = auth()->id();

        abort_unless(

            $conversation->user_one_id === $userId ||
            $conversation->user_two_id === $userId,

            403
        );

        $validated = $request->validate([

            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $receiverId =
            $conversation->user_one_id === $userId
                ? $conversation->user_two_id
                : $conversation->user_one_id;

        $message = Message::create([

            'conversation_id' => $conversation->id,

            'sender_id' => $userId,

            'receiver_id' => $receiverId,

            'message' => trim(
                $validated['message']
            ),
        ]);

        $conversation->update([

            'last_message_at' => now(),
        ]);

        if ($receiverId === $conversation->user_one_id) {

            $conversation->update([
                'hidden_by_user_one' => false,
            ]);
        }

        if ($receiverId === $conversation->user_two_id) {

            $conversation->update([
                'hidden_by_user_two' => false,
            ]);
        }

        $message->load([
            'sender',
            'receiver',
        ]);

        return new MessageResource(
            $message
        );
    }
}
