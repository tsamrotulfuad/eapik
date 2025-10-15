<?php

namespace App\Filament\Brida\Resources\InovasiMasyarakatResource\Pages;

use App\Filament\Brida\Resources\InovasiMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInovasiMasyarakats extends ListRecords
{
    protected static string $resource = InovasiMasyarakatResource::class;

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
