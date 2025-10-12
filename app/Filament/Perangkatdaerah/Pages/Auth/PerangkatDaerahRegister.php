<?php

namespace App\Filament\Perangkatdaerah\Pages\Auth;

use Filament\Pages\Page;
use Filament\Pages\Auth\Register;
use Illuminate\Database\Eloquent\Model;

class PerangkatDaerahRegister extends Register
{
   protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);
        $user->assignRole('panel_perangkat_daerah');

        return $user;
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['username'] = 'perangkatdaerah';
        return $data;
    }
}
