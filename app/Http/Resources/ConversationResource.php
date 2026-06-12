<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'book_id' => $this['book_id'],

            'book_title' => $this['book_title'],

            'other_user_id' => $this['other_user_id'],

            'other_user_name' => $this['other_user_name'],

            'last_message' => $this['last_message'],

            'last_message_at' => $this['last_message_at'],
        ];
    }
}
