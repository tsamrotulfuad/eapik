<?php

namespace App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource\Pages;

use App\Filament\Perangkatdaerah\Resources\InovasiPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInovasiPerangkatDaerah extends EditRecord
{
    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
