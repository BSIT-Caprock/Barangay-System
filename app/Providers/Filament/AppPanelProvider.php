<?php

namespace App\Providers\Filament;

use Filament\Forms;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        \Filament\Tables\Columns\TextColumn::class => \App\Bindings\Filament\Tables\Columns\TextColumn::class,
    ];

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->brandLogo(fn () => view('app.logo'))
            ->brandLogoHeight('2.5rem')
            ->path('')
            // ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
                // Authenticate::class,
            ])
            ->renderHook(
                PanelsRenderHook::TOPBAR_END,
                fn () => Blade::render('<x-filament-panels::theme-switcher />'),
            );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Forms\Components\Select::configureUsing(function (Forms\Components\Select $select): void {
            $select
                ->native(false);
        });
        Forms\Components\DateTimePicker::configureUsing(function (Forms\Components\DateTimePicker $dateTimePicker): void {
            $dateTimePicker
                ->native(false)
                ->timezone('Asia/Manila')
                ->displayFormat('F j, Y h:i A')
                ->weekStartsOnSunday();
        });
        Forms\Components\DatePicker::configureUsing(function (Forms\Components\DatePicker $datePicker): void {
            $datePicker
                ->displayFormat('F j, Y');
        });
        Tables\Table::configureUsing(function (Tables\Table $table): void {
            $table->actionsPosition(Tables\Enums\ActionsPosition::BeforeColumns);
        });
        Tables\Columns\Column::configureUsing(function (Tables\Columns\Column $column): void {
            $column
                ->sortable();
        });
    }
}
