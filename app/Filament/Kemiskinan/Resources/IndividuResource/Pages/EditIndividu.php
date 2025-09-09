<?php

namespace App\Filament\Kemiskinan\Resources\IndividuResource\Pages;

use Filament\Actions;
use Illuminate\Support\Carbon;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Kemiskinan\Resources\IndividuResource;

class EditIndividu extends EditRecord
{
    protected static string $resource = IndividuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Hitung umur dari tanggal_lahir sebelum form diisi
        $data['umur'] = !empty($data['tanggal_lahir'])
            ? Carbon::parse($data['tanggal_lahir'])->age
            : null;

        return $data;
    }
}
