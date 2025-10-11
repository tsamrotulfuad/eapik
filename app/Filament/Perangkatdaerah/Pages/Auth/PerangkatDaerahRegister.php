<?php

namespace App\Filament\Perangkatdaerah\Pages\Auth;

use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class PerangkatDaerahRegister extends Page
{
    protected function handleRegistration(array $data): Model
    {
         $user = $this->getUserModel()::create($data);
         $user->assignRole('panel_perangkat_daerah');
 
         return $user;
    }
}