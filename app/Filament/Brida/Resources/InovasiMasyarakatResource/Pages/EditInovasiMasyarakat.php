<?php

namespace App\Filament\Brida\Resources\InovasiMasyarakatResource\Pages;

use App\Filament\Brida\Resources\InovasiMasyarakatResource;
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
