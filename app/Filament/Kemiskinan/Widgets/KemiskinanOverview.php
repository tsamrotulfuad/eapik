<?php

namespace App\Filament\Kemiskinan\Widgets;

use App\Models\Bantuan;
use App\Models\Individu;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class KemiskinanOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Bantuan', Bantuan::count()),
            Stat::make('Individu', Individu::count()),
        ];
    }
}
