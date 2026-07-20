<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportPageContent extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'intro_text',
        'why_it_exists_text',
        'why_we_ask_text',
        'pix_key',
        'livepix_url',
        'apoiase_url',
        'transparency_text',
        'contact_email',
    ];

    /**
     * Tabela singleton (sempre uma unica linha, criada pela migration).
     */
    public static function current(): self
    {
        return static::query()->firstOrFail();
    }
}
