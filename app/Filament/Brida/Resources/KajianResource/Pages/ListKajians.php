<?php

namespace App\Filament\Brida\Resources\KajianResource\Pages;

use App\Filament\Brida\Resources\KajianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKajians extends ListRecords
{
    protected static string $resource = KajianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
