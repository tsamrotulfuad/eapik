<?php

namespace App\Filament\Resources\UsulanResource\Pages;

use App\Filament\Resources\UsulanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulans extends ListRecords
{
    protected static string $resource = UsulanResource::class;

    public function getHeading(): string
    {
        return 'Usulan Kamus';
    }

    public function getBreadcrumb(): string
    {
        return 'Usulan Kamus';
    }

    public function getTitle(): string
    {
        return 'Usulan Kamus';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
