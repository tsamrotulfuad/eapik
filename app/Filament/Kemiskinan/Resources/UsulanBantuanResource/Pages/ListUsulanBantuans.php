<?php

namespace App\Filament\Kemiskinan\Resources\UsulanBantuanResource\Pages;

use App\Filament\Kemiskinan\Resources\UsulanBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulanBantuans extends ListRecords
{
    protected static string $resource = UsulanBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
