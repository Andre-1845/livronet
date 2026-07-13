<?php

namespace App\Filament\Resources\ConversationResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $title = 'Mensagens';

    // Somente leitura: ferramenta de moderação, não de edição de
    // conteúdo de terceiros.
    public function canCreate(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sender.name')
                    ->label('De'),

                TextColumn::make('message')
                    ->label('Mensagem')
                    ->wrap()
                    ->limit(200),

                TextColumn::make('created_at')
                    ->label('Enviada em')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('read_at')
                    ->label('Lida em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Não lida'),
            ])
            ->defaultSort('created_at', 'asc');
    }
}
