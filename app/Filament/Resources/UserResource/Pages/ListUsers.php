<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    // Sem ação de "criar" aqui de propósito: usuários se cadastram
    // pelo próprio app (com senha, verificação de e-mail etc.), então
    // criar um usuário direto pelo painel ficaria incompleto/quebrado.
    protected function getHeaderActions(): array
    {
        return [];
    }
}
