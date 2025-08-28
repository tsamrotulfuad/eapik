<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\Pages;

use App\Filament\Kemiskinan\Resources\BantuanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBantuan extends CreateRecord
{
    protected static string $resource = BantuanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
