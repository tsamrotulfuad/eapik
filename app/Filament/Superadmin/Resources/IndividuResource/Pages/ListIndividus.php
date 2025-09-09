<?php

namespace App\Filament\Superadmin\Resources\IndividuResource\Pages;

use App\Filament\Superadmin\Resources\IndividuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndividus extends ListRecords
{
    protected static string $resource = IndividuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
