<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'subject_id',

        'title',
        'author',
        'publisher',
        'edition',
        'school_grade',
        'isbn',

        'price',

        'accept_trade',
        'accept_sale',
        'accept_donation',

        'description',

        'image',

        'is_available',
    ];

    protected $casts = [

        'accept_trade' => 'boolean',
        'accept_sale' => 'boolean',
        'accept_donation' => 'boolean',
        'is_available' => 'boolean',

        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
