<?php

namespace App\Filament\Kepegawaian\Resources\SasaranKinerjaResource\Pages;

use App\Filament\Kepegawaian\Resources\SasaranKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSasaranKinerja extends CreateRecord
{
    protected static string $resource = SasaranKinerjaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
