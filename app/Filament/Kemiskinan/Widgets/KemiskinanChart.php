<?php

namespace App\Filament\Kemiskinan\Widgets;

use Filament\Widgets\ChartWidget;

class KemiskinanChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $jumlahBantuan = \App\Models\Bantuan::count();
        $jumlahKeluarga = \App\Models\Keluarga::count();
        $jumlahIndividu = \App\Models\Individu::count();

        return [
            [
                'label' => 'Jumlah Data',
                'data' => [$jumlahBantuan, $jumlahKeluarga, $jumlahIndividu],
                'backgroundColor' => ['#36A2EB', '#FFCE56', '#FF6384'],
            ],
            'labels' => ['Bantuan', 'Keluarga', 'Individu'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';
}
