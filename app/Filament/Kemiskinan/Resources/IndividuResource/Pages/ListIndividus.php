<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Exports\IndividuExport;
use App\Imports\IndividuImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Kemiskinan\Resources\IndividuResource;

class ListIndividus extends ListRecords
{
    protected static string $resource = IndividuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data'),
            Action::make('import')
                ->label('Import')
                ->form([
                    FileUpload::make('file')
                        ->label('Upload File Excel')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                        ->disk('local')
                        ->visibility('private')
                        ->directory('imports/individu')
                        ->preserveFilenames()
                        ->maxSize(64000)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    Excel::import(new IndividuImport, $data['file']->getRealPath());
                })
                ->color('warning')
                ->icon('heroicon-o-arrow-down-tray'),
            Action::make('export')
                ->label('Export')
                ->action(fn () => Excel::download(new IndividuExport, 'individus.xlsx'))
                ->color('success')
                ->icon('heroicon-o-arrow-up-tray'),
        ];
    }
}
