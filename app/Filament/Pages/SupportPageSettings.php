<?php

namespace App\Filament\Pages;

use App\Models\SupportPageContent;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SupportPageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Página de Apoio';

    protected static ?string $navigationGroup = 'Conteúdo do site';

    protected static ?string $title = 'Página de Apoio ao Projeto';

    protected static string $view = 'filament.pages.support-page-settings';

    /**
     * @var array<string, mixed>
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            SupportPageContent::current()->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Conteúdo')
                    ->description('Exibido em livronet.org/apoie — a página que o app abre quando alguém decide apoiar o projeto.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->label('Subtítulo')
                            ->required()
                            ->maxLength(255),

                        RichEditor::make('intro_text')
                            ->label('Texto de introdução')
                            ->required()
                            ->columnSpanFull(),

                        RichEditor::make('why_it_exists_text')
                            ->label('Por que o projeto existe')
                            ->columnSpanFull(),

                        RichEditor::make('why_we_ask_text')
                            ->label('Por que pedimos apoio')
                            ->columnSpanFull(),

                        RichEditor::make('transparency_text')
                            ->label('Transparência')
                            ->columnSpanFull(),
                    ]),

                Section::make('Formas de apoiar')
                    ->description('Deixe em branco a forma que ainda não estiver pronta — ela simplesmente não aparece na página.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('pix_key')
                            ->label('Chave Pix'),

                        TextInput::make('livepix_url')
                            ->label('Link do Livepix')
                            ->url(),

                        TextInput::make('apoiase_url')
                            ->label('Link do Apoia.se')
                            ->url(),

                        TextInput::make('contact_email')
                            ->label('E-mail de contato')
                            ->email()
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        SupportPageContent::current()->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Página de apoio atualizada')
            ->success()
            ->send();
    }
}
