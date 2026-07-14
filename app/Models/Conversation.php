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
        // withTrashed: mesmo que o dono apague o livro depois, o
        // histórico da conversa continua mostrando qual livro era.
        return $this->belongsTo(Book::class)->withTrashed();
    }

    public function userOne()
    {
        // withTrashed: se essa pessoa excluir a conta depois, a
        // conversa continua existindo pro outro usuário (mostrando
        // "Usuário removido", já que os dados são anonimizados).
        return $this->belongsTo(User::class, 'user_one_id')->withTrashed();
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id')->withTrashed();
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
