<?php

namespace App\Filament\Brida\Resources\InovasiResource\Pages;

use Filament\Actions;
use App\Models\Inovasi;
use Filament\Actions\Action;
use App\Exports\InovasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Brida\Resources\InovasiResource;

class ListInovasis extends ListRecords
{
    protected static string $resource = InovasiResource::class;

    public function getTitle(): string
    {
        return 'Inovasi';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah data'),
             Action::make('export')
                ->label('Export')
                ->action(fn () => Excel::download(new InovasiExport, 'inovasi.xlsx'))
                ->color('success')
                ->icon('heroicon-o-arrow-up-tray'),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar Inovasi';
    }
}
