<?php

namespace App\Filament\Kelurahan\Resources\UsulanResource\Pages;

use App\Filament\Kelurahan\Resources\UsulanResource;
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
