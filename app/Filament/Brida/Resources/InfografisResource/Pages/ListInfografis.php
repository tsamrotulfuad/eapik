<?php

namespace App\Filament\Brida\Resources\InfografisResource\Pages;

use App\Filament\Brida\Resources\InfografisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfografis extends ListRecords
{
    protected static string $resource = InfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
