<?php

namespace App\Filament\Kemiskinan\Widgets;

use App\Models\Bantuan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BantuansOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Bantuan', Bantuan::count()),
        ];
    }
}
