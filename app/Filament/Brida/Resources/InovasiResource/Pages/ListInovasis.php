<?php

namespace App\Filament\Brida\Resources\InovasiResource\Pages;

use App\Filament\Brida\Resources\InovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar Inovasi';
    }
}
