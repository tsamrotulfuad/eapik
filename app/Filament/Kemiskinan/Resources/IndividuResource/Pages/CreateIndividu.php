<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\Pages;

use App\Filament\Kemiskinan\Resources\IndividuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndividu extends CreateRecord
{
    protected static string $resource = IndividuResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['umur'] = auth()->id();
    //     return $data;
    // }
}
