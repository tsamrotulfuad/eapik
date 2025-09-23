<?php

namespace App\Filament\Kemiskinan\Resources\BantuanResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Kemiskinan\Resources\BantuanResource;

class EditBantuan extends EditRecord
{
    protected static string $resource = BantuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('kelolaPenerima')
                ->label('Kelola Penerima')
                ->icon('heroicon-o-users')
                ->url(fn () => url("kemiskinan/bantuans/{$this->record->getKey()}/kelola-penerima")),
        ];
    }
}
