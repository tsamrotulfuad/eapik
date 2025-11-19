<?php

namespace App\Filament\Kemiskinan\Resources\UsulanBantuanResource\Pages;

use App\Filament\Kemiskinan\Resources\UsulanBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsulanBantuan extends EditRecord
{
    protected static string $resource = UsulanBantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
