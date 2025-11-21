<?php

namespace App\Filament\Kemiskinan\Resources\UsulanBantuanResource\Pages;

use App\Filament\Kemiskinan\Resources\UsulanBantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsulanBantuan extends CreateRecord
{
    protected static string $resource = UsulanBantuanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
