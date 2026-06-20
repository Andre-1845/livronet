<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [

        'book_id',
        'user_one_id',
        'user_two_id',
        'last_message_id',
        'last_message_at',
        'hidden_by_user_one',
        'hidden_by_user_two',
    ];

    protected $casts = [

        'last_message_at' => 'datetime',

        'hidden_by_user_one' => 'boolean',
        'hidden_by_user_two' => 'boolean',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function otherUser(int $userId)
    {
        return $this->user_one_id === $userId
            ? $this->userTwo
            : $this->userOne;
    }


}
