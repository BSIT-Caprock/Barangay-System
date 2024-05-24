<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Resources\HouseholdResource\Widgets\HouseholdCount;
use App\Filament\Resources\InhabitantResource\Widgets\TotalInhabitants;
use App\Filament\Widgets\InhabitantAgeGroupsChart;
use App\Filament\Widgets\InhabitantCivilStatusRatioChart;
use App\Filament\Widgets\MaleAndFemaleInhabitantsRatioChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Voltra\FilamentSvgAvatar\Filament\AvatarProviders\SvgAvatarsProviders;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // identification
            ->default()
            ->id('admin')
            ->path('/')
            ->brandName(env('BRGY_FULL'))
            // authentication
            ->login()
            ->registration()
            ->emailVerification()
            ->passwordReset()
            // database
            ->databaseNotifications()
            // icon and color
            ->favicon(asset('images/barugo-logo.jpg'))
            ->defaultAvatarProvider(SvgAvatarsProviders::class)
            ->colors([
                'primary' => Color::Blue,
            ])
            // layout and navigation
            ->spa()
            ->navigationItems([
                // this is for the user manual page
                NavigationItem::make('User Manual')
                    //url will be change when the system is completed
                    ->url('https://bit.ly/40pP3f1', shouldOpenInNewTab: true)
                    ->icon('heroicon-s-information-circle')
                    ->group('Guide')
                    ->sort(2),
                // this is for the feedback to be fill up, you can change the link
                NavigationItem::make('Feedback')
                    //url will be change when it need to be updated
                    ->url('https://forms.gle/oofsT22pbQNM8d2x8', shouldOpenInNewTab: true)
                    ->icon('heroicon-s-link')
                    ->group('Guide')
                    ->sort(2),
            ])
            // resources
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // pages
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            // widgets
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                MaleAndFemaleInhabitantsRatioChart::class,
                InhabitantCivilStatusRatioChart::class,
                InhabitantAgeGroupsChart::class,
                TotalInhabitants::class,
                HouseholdCount::class,
            ])
            // middleware
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
            ])
            // plugins
            ->plugins([
                SpotlightPlugin::make(),
            ]);
    }
}
