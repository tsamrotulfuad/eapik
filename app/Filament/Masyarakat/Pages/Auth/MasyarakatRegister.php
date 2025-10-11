<?php

namespace App\Filament\Masyarakat\Pages\Auth;

use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class MasyarakatRegister extends Page
{
    protected function handleRegistration(array $data): Model
    {
            $user = $this->getUserModel()::create($data);
            $user->assignRole('panel_masyarakat');

            return $user;
    }
}
