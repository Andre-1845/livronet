<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Livros';

    protected static ?string $modelLabel = 'livro';

    protected static ?string $pluralModelLabel = 'livros';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Livro')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('author')
                        ->label('Autor')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('publisher')
                        ->label('Editora')
                        ->maxLength(255),

                    TextInput::make('edition')
                        ->label('Edição')
                        ->maxLength(50),

                    TextInput::make('isbn')
                        ->label('ISBN')
                        ->maxLength(50),

                    TextInput::make('price')
                        ->label('Preço')
                        ->numeric()
                        ->prefix('R$'),

                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Dono do livro')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('subject_id')
                        ->relationship('subject', 'name')
                        ->label('Matéria')
                        ->searchable()
                        ->preload(),

                    Select::make('grade_id')
                        ->relationship('grade', 'name')
                        ->label('Série')
                        ->searchable()
                        ->preload(),
                ]),

            Section::make('Modalidades e status')
                ->columns(4)
                ->schema([
                    Toggle::make('accept_trade')->label('Aceita troca'),
                    Toggle::make('accept_sale')->label('Aceita venda'),
                    Toggle::make('accept_donation')->label('Aceita doação'),
                    Toggle::make('is_available')->label('Disponível'),
                ]),

            Section::make('Descrição')
                ->schema([
                    Textarea::make('description')
                        ->label('Descrição')
                        ->rows(3)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author')
                    ->label('Autor')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Dono')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject.name')
                    ->label('Matéria')
                    ->toggleable(),

                IconColumn::make('accept_trade')
                    ->label('Troca')
                    ->boolean(),

                IconColumn::make('accept_sale')
                    ->label('Venda')
                    ->boolean(),

                IconColumn::make('accept_donation')
                    ->label('Doação')
                    ->boolean(),

                IconColumn::make('is_available')
                    ->label('Disponível')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Publicado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('deleted_at')
                    ->label('Excluído em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),

                TernaryFilter::make('is_available')
                    ->label('Disponível'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
