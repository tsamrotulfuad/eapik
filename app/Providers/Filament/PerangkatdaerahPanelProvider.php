<?php

namespace App\Providers\Filament;

use App\Filament\Perangkatdaerah\Pages\Auth\PerangkatDaerahRegister;
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

class PerangkatdaerahPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
     {
        return $panel
            ->id('perangkatdaerah')
            ->path('rekakarsacipta/perangkatdaerah')
            ->login()
            ->registration(PerangkatDaerahRegister::class)
            ->emailVerification()
            ->passwordReset()
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop(true)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Perangkatdaerah/Resources'), for: 'App\\Filament\\Perangkatdaerah\\Resources')
            ->discoverPages(in: app_path('Filament/Perangkatdaerah/Pages'), for: 'App\\Filament\\Perangkatdaerah\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Perangkatdaerah/Widgets'), for: 'App\\Filament\\Perangkatdaerah\\Widgets')
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
