<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SmartFarmingPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('smart-farming')
            ->path('smart-farming')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->spa()
            ->unsavedChangesAlerts()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            // ->databaseTransactions()
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->navigationGroups([
                'Irrigation & Monitoring',
                'System Settings'
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            // ->widgets([
            //     Widgets\AccountWidget::class,
            //     Widgets\FilamentInfoWidget::class,
            // ])
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('9rem')
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    // ->url(fn (): string => Settings::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
                MenuItem::make()
                    ->icon('heroicon-o-cog-6-tooth')
                    ->label('Lock session'),
                // ->postAction(fn(): string => route('lock-session'))
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
