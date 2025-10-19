<?php

namespace App\Filament\Superadmin\Resources\BidangResource\Pages;

use App\Filament\Superadmin\Resources\BidangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBidangs extends ListRecords
{
    protected static string $resource = BidangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
