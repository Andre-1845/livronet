<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'key',
        'subject',
        'body',
        'button_text',
        'closing_text',
    ];

    /**
     * Busca o template pela chave fixa usada no codigo (ex:
     * 'verify_email'). As linhas sao criadas pela migration e editadas
     * pelo painel Filament -- nunca criadas/apagadas em tempo de
     * execucao, por isso findOrFail aqui e um erro real se acontecer.
     */
    public static function forKey(string $key): self
    {
        return static::where('key', $key)->firstOrFail();
    }
}
