<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title' => $this->title,

            'author' => $this->author,

            'publisher' => $this->publisher,

            'edition' => $this->edition,

            'grade' => $this->grade ? [
                'id' => $this->grade->id,
                'name' => $this->grade->name,
            ] : null,

            'isbn' => $this->isbn,

            'price' => $this->price,

            'accept_trade' => $this->accept_trade,

            'accept_sale' => $this->accept_sale,

            'accept_donation' => $this->accept_donation,

            'description' => $this->description,

            'is_available' => $this->is_available,

            'image_url' => $this->image
                ? asset('storage/'.$this->image)
                : null,

            'subject' => [

                'id' => $this->subject->id,

                'name' => $this->subject->name,
            ],

            'user' => [

                'id' => $this->user->id,

                'name' => $this->user->name,

                'email' => $this->user->email,

                'city' => $this->user->city?->name,

                'school' => $this->user->school?->name,

                'whatsapp' => $this->user->whatsapp,

                'instagram' => $this->user->instagram,
            ],

            'is_favorite' => $request->user()
                 ? $this->favoritedBy->contains('id', $request->user()->id)
                 : false,

        ];
    }
}
