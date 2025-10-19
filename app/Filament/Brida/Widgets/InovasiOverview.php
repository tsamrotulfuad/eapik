<?php

namespace App\Filament\Brida\Widgets;

use App\Models\Inovasi;
use App\Models\InovasiMasyarakat;
use App\Models\InovasiPerangkatDaerah;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class InovasiOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Daftar Inovasi IGA', Inovasi::count()),
            Stat::make('Inovasi Tata Kelola Pemerintah', InovasiPerangkatDaerah::where('bentuk_inovasi', '=', 'Inovasi Tata Kelola Pemerintahan Daerah')->count()),
            Stat::make('Inovasi Pelayanan Publik', InovasiPerangkatDaerah::where('bentuk_inovasi', '=', 'Inovasi Pelayanan Publik')->count()),
            Stat::make('Inovasi Pendidikan', InovasiPerangkatDaerah::where('bentuk_inovasi', '=', 'Inovasi Pendidikan')->count()),
            Stat::make('Inovasi Masyarakat', InovasiMasyarakat::count()),
        ];
    }
}
