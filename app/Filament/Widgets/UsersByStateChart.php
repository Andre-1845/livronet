<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UsersByStateChart extends ChartWidget
{
    protected static ?string $heading = 'Usuários por Estado';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        // leftJoin pra não perder usuários sem cidade/estado cadastrado
        // (city_id é opcional) -- eles caem no bucket "N/D" em vez de
        // simplesmente somirem da contagem.
        $rows = User::query()
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('states', 'cities.state_id', '=', 'states.id')
            ->select(
                DB::raw("COALESCE(states.uf, 'N/D') as uf"),
                DB::raw('count(*) as total')
            )
            ->groupBy('uf')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Usuários',
                    'data' => $rows->pluck('total'),
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $rows->pluck('uf'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
