<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userId = auth()->id();

        $otherUser =
            $this->user_one_id === $userId
                ? $this->userTwo
                : $this->userOne;

        $lastMessage = $this->messages()
            ->latest('created_at')
            ->first();

        return [

            'id' => $this->id,

            'book' => [

                'id' => $this->book?->id,

                'title' => $this->book?->title,
            ],

            'other_user' => [

                'id' => $otherUser?->id,

                'name' => $otherUser?->name,
            ],

            'last_message' => $lastMessage?->message,

            'last_message_at' => $this->last_message_at?->toDateTimeString(),

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
