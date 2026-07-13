<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConversationResource\Pages;
use App\Filament\Resources\ConversationResource\RelationManagers\MessagesRelationManager;
use App\Models\Conversation;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConversationResource extends Resource
{
    protected static ?string $model = Conversation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Conversas';

    protected static ?string $modelLabel = 'conversa';

    protected static ?string $pluralModelLabel = 'conversas';

    // Somente leitura de propósito: é uma ferramenta de moderação
    // (ver denúncias/abuso), não um lugar para editar conversa de
    // usuário. Sem CreateAction, sem EditAction — só ViewAction.
    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('book.title')
                ->label('Livro')
                ->disabled(),

            TextInput::make('userOne.name')
                ->label('Usuário 1')
                ->disabled(),

            TextInput::make('userTwo.name')
                ->label('Usuário 2')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')
                    ->label('Livro')
                    ->placeholder('(livro removido)')
                    ->searchable(),

                TextColumn::make('userOne.name')
                    ->label('Usuário 1')
                    ->searchable(),

                TextColumn::make('userTwo.name')
                    ->label('Usuário 2')
                    ->searchable(),

                TextColumn::make('messages_count')
                    ->label('Mensagens')
                    ->counts('messages'),

                TextColumn::make('last_message_at')
                    ->label('Última mensagem')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('last_message_at', 'desc');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            MessagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConversations::route('/'),
            'view' => Pages\ViewConversation::route('/{record}'),
        ];
    }
}
