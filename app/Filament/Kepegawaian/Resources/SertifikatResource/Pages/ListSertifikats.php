<?php

namespace App\Filament\Kepegawaian\Resources\SertifikatResource\Pages;

use App\Filament\Kepegawaian\Resources\SertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSertifikats extends ListRecords
{
    protected static string $resource = SertifikatResource::class;

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
        return "Sertifikat";
    }
}
