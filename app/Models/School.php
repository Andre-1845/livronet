<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
