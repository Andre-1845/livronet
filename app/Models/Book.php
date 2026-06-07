<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'grade_id',
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

    protected function title(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => mb_convert_case(
                trim($value),
                MB_CASE_TITLE,
                'UTF-8'
            )
        );
    }

    protected function author(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => mb_convert_case(
                trim($value),
                MB_CASE_TITLE,
                'UTF-8'
            )
        );
    }

    protected function publisher(): Attribute
    {
        return Attribute::make(

            set: fn ($value) => mb_convert_case(
                trim($value),
                MB_CASE_TITLE,
                'UTF-8'
            )
        );
    }

    public function scopeForSale($query)
    {
        return $query->where('accept_sale', true);
    }

    public function scopeForTrade($query)
    {
        return $query->where('accept_trade', true);
    }

    public function scopeForDonation($query)
    {
        return $query->where('accept_donation', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}