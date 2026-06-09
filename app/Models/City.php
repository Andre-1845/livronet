<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'state_id',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_convert_case(
                trim($value),
                MB_CASE_TITLE,
                'UTF-8'
            )
        );
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function state()
{
    return $this->belongsTo(State::class);
}
}