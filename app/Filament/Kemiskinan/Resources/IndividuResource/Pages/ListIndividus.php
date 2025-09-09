<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Exports\IndividuExport;
use App\Imports\IndividuImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
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
                    $relative = $data['file']; // ex: "imports/xxx.xlsx"
                    $path = storage_path('app/' . $relative);

                    try {
                        Excel::queueImport(new IndividuImport, $path);
                    } catch (\Exception $e) {
                        Log::error('Import gagal: ' . $e->getMessage());
                        throw $e; // biarkan Filament menampilkan error
                    } finally {
                        // hapus file upload agar storage tidak penuh
                        Storage::disk('local')->delete($relative);
                    }
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
