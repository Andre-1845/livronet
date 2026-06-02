<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
    ];

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
