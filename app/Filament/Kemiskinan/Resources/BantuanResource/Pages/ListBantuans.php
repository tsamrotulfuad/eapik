<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\Pages;

use App\Filament\Kemiskinan\Resources\BantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBantuans extends ListRecords
{
    protected static string $resource = BantuanResource::class;

     public function getTitle(): string
    {
        return 'Bantuan';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getBreadcrumb(): string
    {
        return 'Daftar Bantuan';
    }
}