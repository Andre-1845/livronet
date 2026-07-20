<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmailTemplateResource\Pages;
use App\Models\EmailTemplate;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmailTemplateResource extends Resource
{
    protected static ?string $model = EmailTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'E-mails automáticos';

    protected static ?string $navigationGroup = 'Conteúdo do site';

    protected static ?string $modelLabel = 'e-mail automático';

    protected static ?string $pluralModelLabel = 'e-mails automáticos';

    // Templates fixos do sistema (verificação de conta, redefinição de
    // senha, exclusão de conta) -- criados e removidos só via migration,
    // nunca pelo painel. Aqui só edição.
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Identificação')
                ->schema([
                    TextInput::make('key')
                        ->label('Identificador')
                        ->disabled()
                        ->dehydrated(false)
                        ->helperText('Usado internamente pelo sistema, não pode ser alterado.'),

                    TextInput::make('subject')
                        ->label('Assunto do e-mail')
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Conteúdo')
                ->schema([
                    RichEditor::make('body')
                        ->label('Corpo do e-mail')
                        ->helperText('Use :name para inserir o nome do destinatário. No e-mail de redefinição de senha, :expire_minutes insere a validade do link em minutos.')
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('button_text')
                        ->label('Texto do botão')
                        ->required()
                        ->maxLength(100),

                    Textarea::make('closing_text')
                        ->label('Aviso final (texto pequeno, cinza)')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Identificador')
                    ->badge(),

                TextColumn::make('subject')
                    ->label('Assunto')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmailTemplates::route('/'),
            'edit' => Pages\EditEmailTemplate::route('/{record}/edit'),
        ];
    }
}
