<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GeneralStatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Total de Usuários', User::count())
                ->description('Usuários cadastrados na plataforma')
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Total de Livros', Book::count())
                ->description('Livros cadastrados na plataforma')
                ->icon('heroicon-o-book-open')
                ->color('primary'),

            Stat::make('Para Troca', Book::forTrade()->count())
                ->description('Livros disponíveis para troca')
                ->icon('heroicon-o-arrow-path')
                ->color('info'),

            Stat::make('Para Doação', Book::forDonation()->count())
                ->description('Livros disponíveis para doação')
                ->icon('heroicon-o-gift')
                ->color('success'),

            Stat::make('Para Venda', Book::forSale()->count())
                ->description('Livros disponíveis para venda')
                ->icon('heroicon-o-currency-dollar')
                ->color('warning'),
        ];
    }
}
