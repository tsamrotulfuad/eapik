<?php

namespace App\Filament\Superadmin\Resources\InovasiPerangkatDaerahResource\Pages;

use App\Filament\Superadmin\Resources\InovasiPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInovasiPerangkatDaerah extends EditRecord
{
    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
