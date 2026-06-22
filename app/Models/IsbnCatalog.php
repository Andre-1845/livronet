<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsbnCatalog extends Model
{
    protected $table = 'isbn_catalog';

    protected $fillable = [

        'isbn',

        'title',

        'author',

        'publisher',

        'published_date',

        'edition',

        'cover_url',

        'local_cover_path',

        'source',

        'subjects',

        'lookup_count',

        'last_lookup_at',

        'last_api_refresh_at',

        'api_response_hash',

        'is_active',
    ];

    protected $casts = [

        'subjects' => 'array',

        'last_lookup_at' => 'datetime',

        'last_api_refresh_at' => 'datetime',

        'is_active' => 'boolean',
    ];
}
