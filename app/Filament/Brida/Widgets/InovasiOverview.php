<?php

namespace App\Filament\Brida\Widgets;

use App\Models\InovasiMasyarakat;
use App\Models\InovasiPerangkatDaerah;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InovasiOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Inovasi Perangakat Daerah', InovasiPerangkatDaerah::count()),
            Stat::make('Inovasi Masyarakat', InovasiMasyarakat::count()),
        ];
    }
}
