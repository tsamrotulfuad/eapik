<?php

namespace App\Filament\Juri\Resources\InovasiMasyarakatResource\Pages;

use App\Filament\Juri\Resources\InovasiMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInovasiMasyarakat extends EditRecord
{
    protected static string $resource = InovasiMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
