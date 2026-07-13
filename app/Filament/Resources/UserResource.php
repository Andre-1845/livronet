<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Usuários';

    protected static ?string $modelLabel = 'usuário';

    protected static ?string $pluralModelLabel = 'usuários';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Dados do usuário')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('E-mail')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('phone')
                        ->label('Telefone')
                        ->maxLength(30),

                    TextInput::make('whatsapp')
                        ->label('WhatsApp')
                        ->maxLength(30),

                    TextInput::make('instagram')
                        ->label('Instagram')
                        ->maxLength(100),
                ]),

            Section::make('Permissões')
                ->description('Cuidado: quem tiver este campo marcado consegue acessar este painel administrativo.')
                ->schema([
                    Toggle::make('is_admin')
                        ->label('É administrador'),
                ]),

            // Importante: nenhum campo de senha é exposto aqui de propósito.
            // Reset de senha do usuário continua sendo feito pelo fluxo
            // normal de "esqueci minha senha" do próprio app.
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city.name')
                    ->label('Cidade')
                    ->toggleable(),

                TextColumn::make('school.name')
                    ->label('Escola')
                    ->toggleable(),

                IconColumn::make('email_verified_at')
                    ->label('E-mail verificado')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => ! is_null($record->email_verified_at)),

                IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Cadastrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_admin')
                    ->label('Administrador'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
