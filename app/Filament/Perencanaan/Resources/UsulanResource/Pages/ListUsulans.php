<?php

namespace App\Filament\Perencanaan\Resources\UsulanResource\Pages;

use App\Filament\Perencanaan\Resources\UsulanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulans extends ListRecords
{
    protected static string $resource = UsulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data'),
        ];
    }
}
