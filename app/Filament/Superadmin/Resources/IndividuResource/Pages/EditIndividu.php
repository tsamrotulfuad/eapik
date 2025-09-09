<?php

namespace App\Filament\Superadmin\Resources\IndividuResource\Pages;

use App\Filament\Superadmin\Resources\IndividuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndividu extends EditRecord
{
    protected static string $resource = IndividuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
