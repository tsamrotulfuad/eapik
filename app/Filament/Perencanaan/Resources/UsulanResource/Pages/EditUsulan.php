<?php

namespace App\Filament\Perencanaan\Resources\UsulanResource\Pages;

use App\Filament\Perencanaan\Resources\UsulanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsulan extends EditRecord
{
    protected static string $resource = UsulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
