<?php

namespace App\Filament\Masyarakat\Resources\InovasiMasyarakatResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Masyarakat\Resources\InovasiMasyarakatResource;

class CreateInovasiMasyarakat extends CreateRecord
{
    protected static string $resource = InovasiMasyarakatResource::class;

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
