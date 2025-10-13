<?php

namespace App\Filament\Resources\InovasiPerangkatDaerahResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InovasiPerangkatDaerahResource;

class CreateInovasiPerangkatDaerah extends CreateRecord
{
    protected static string $resource = InovasiPerangkatDaerahResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tahun'] = Carbon::now()->format('Y');
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getHeading(): string
    {
        return 'Tambah Inovasi';
    }

    public function getBreadcrumb(): string
    {
        return 'Tambah Inovasi';
    }

    public function getTitle(): string
    {
        return 'Inovasi';
    }
}
