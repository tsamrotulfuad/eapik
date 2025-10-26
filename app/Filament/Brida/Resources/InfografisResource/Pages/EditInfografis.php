<?php

namespace App\Filament\Brida\Resources\InfografisResource\Pages;

use App\Filament\Brida\Resources\InfografisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfografis extends EditRecord
{
    protected static string $resource = InfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
