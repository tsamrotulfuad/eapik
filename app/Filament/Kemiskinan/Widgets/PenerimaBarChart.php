<?php

namespace App\Filament\Kemiskinan\Widgets;

use App\Models\Individu;
use Filament\Widgets\ChartWidget;

class PenerimaBarChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penerima Bantuan per Bulan';
    protected static string $color = 'primary';

    protected function getData(): array
    {
        // Ambil data penerima per bulan
        $data = Individu::selectRaw('MONTH(bantuan_individu.tanggal_terima) as bulan, COUNT(*) as total')
            ->join('bantuan_individu', 'individus.id', '=', 'bantuan_individu.individu_id')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $series = [];

        foreach (range(1, 12) as $month) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 10));
            $series[] = $data[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penerima',
                    'data' => $series,
                    'backgroundColor' => '#3B82F6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // tipe bar chart
    }
}
