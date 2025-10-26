<?php

namespace App\Filament\Brida\Resources\InfografisResource\Pages;

use App\Filament\Brida\Resources\InfografisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfografis extends CreateRecord
{
    protected static string $resource = InfografisResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
