<?php

namespace App\Filament\Masyarakat\Resources\InovasiMasyarakatResource\Pages;

use App\Filament\Masyarakat\Resources\InovasiMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInovasiMasyarakat extends EditRecord
{
    protected static string $resource = InovasiMasyarakatResource::class;

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
