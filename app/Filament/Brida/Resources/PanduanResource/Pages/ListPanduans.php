<?php

namespace App\Filament\Brida\Resources\PanduanResource\Pages;

use App\Filament\Brida\Resources\PanduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanduans extends ListRecords
{
    protected static string $resource = PanduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
