<?php

namespace App\Filament\Kelurahan\Resources\UsulanResource\Pages;

use App\Filament\Kelurahan\Resources\UsulanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsulan extends CreateRecord
{
    protected static string $resource = UsulanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
