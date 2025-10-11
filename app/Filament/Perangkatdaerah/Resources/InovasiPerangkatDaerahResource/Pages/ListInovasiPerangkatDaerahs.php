<?php

namespace App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource\Pages;

use App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInovasiPerangkatDaerahs extends ListRecords
{
    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected static ?string $breadcrumb = "List";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah Inovasi'),
        ];
    }

    public function getTitle() : string
    {
        return "List Inovasi";
    }
}
