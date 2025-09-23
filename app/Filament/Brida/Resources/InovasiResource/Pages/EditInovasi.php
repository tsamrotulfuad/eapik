<?php

namespace App\Filament\Brida\Resources\InovasiResource\Pages;

use App\Filament\Brida\Resources\InovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInovasi extends EditRecord
{
    protected static string $resource = InovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
