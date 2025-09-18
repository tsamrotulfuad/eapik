<?php

namespace App\Filament\Kepegawaian\Resources\SasaranKinerjaResource\Pages;

use App\Filament\Kepegawaian\Resources\SasaranKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSasaranKinerjas extends ListRecords
{
    protected static string $resource = SasaranKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Data'),
        ];
    }

    protected static ?string $breadcrumb = "List";

    public function getTitle() : string
    {
        return "Sasaran Kinerja Pegawai";
    }
}
