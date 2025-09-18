<?php

namespace App\Filament\Kepegawaian\Resources\SasaranKinerjaResource\Pages;

use App\Filament\Kepegawaian\Resources\SasaranKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSasaranKinerja extends EditRecord
{
    protected static string $resource = SasaranKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
