<?php

namespace App\Filament\Brida\Resources\InovasiResource\Pages;

use App\Filament\Brida\Resources\InovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInovasi extends CreateRecord
{
    protected static string $resource = InovasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
