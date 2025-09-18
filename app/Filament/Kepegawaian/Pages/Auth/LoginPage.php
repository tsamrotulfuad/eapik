<?php

namespace App\Filament\Kepegawaian\Pages\Auth;

use Filament\Pages\Page;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;

class LoginPage extends BaseLogin
{
    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('username')
            ->label('Username / NIP')
            ->required()
            ->autocomplete('username')
            ->autofocus();
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
    }
}
