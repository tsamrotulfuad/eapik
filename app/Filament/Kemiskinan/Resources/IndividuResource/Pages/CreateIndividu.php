<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\Pages;

use App\Filament\Kemiskinan\Resources\IndividuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndividu extends CreateRecord
{
    protected static string $resource = IndividuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is_verified'] ?? false) {
            $data['verified_at'] = now();
        } else {
            $data['verified_at'] = null;
        }
        return $data;
    }
}
