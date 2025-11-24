<?php

namespace App\Providers\Filament;

use App\Filament\Masyarakat\Pages\Auth\MasyarakatRegister;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class MasyarakatPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
   {
        return $panel
            ->id('masyarakat')
            ->path('rekakarsacipta/masyarakat')
            ->login()
            ->registration(MasyarakatRegister::class)
            ->emailVerification()
            ->passwordReset()
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop(true)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Masyarakat/Resources'), for: 'App\\Filament\\Masyarakat\\Resources')
            ->discoverPages(in: app_path('Filament/Masyarakat/Pages'), for: 'App\\Filament\\Masyarakat\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Masyarakat/Widgets'), for: 'App\\Filament\\Masyarakat\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
