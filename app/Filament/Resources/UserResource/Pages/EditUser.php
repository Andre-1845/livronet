<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // Sem DeleteAction de propósito: excluir um usuário hoje causa
    // cascade delete de verdade (books, conversations, messages — ver
    // FKs com cascadeOnDelete), inclusive de dados da OUTRA pessoa
    // envolvida numa conversa. Isso precisa de um fluxo dedicado de
    // exclusão de conta (a mesma pendência da Fase 4 que discutimos
    // pra Play Store), não um botão solto de "excluir" no painel.
    protected function getHeaderActions(): array
    {
        return [];
    }
}
