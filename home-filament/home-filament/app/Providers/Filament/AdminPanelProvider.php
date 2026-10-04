<?php

namespace App\Providers\Filament;

use App\Http\Middleware\SetLocale;
use Filament\Actions\Action;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors(['primary' => Color::Indigo])
            ->darkMode(false) // the Blade layout has no dark mode, so keep both the same
            ->brandName(config('app.name'))
            ->homeUrl('/dashboard') // clicking the logo goes to the Blade dashboard
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources',
            )

            // --- Make Filament pages look like the Blade layout -------------------------
            // Left navigation: "Dashboard" (Blade page) + group "Beheer" > "Gebruikers"
            // (the group comes from UserResource). Labels are closures so they are
            // translated per request, after SetLocale ran.
            ->navigationItems([
                NavigationItem::make()
                    ->label(fn (): string => __('messages.dashboard'))
                    ->url('/dashboard')
                    ->icon('heroicon-o-home')
                    ->sort(-1),
            ])
            // User menu (top right): extra "Settings" link to the Blade profile page.
            // "Log out" is built into Filament.
            ->userMenuItems([
                Action::make('settings')
                    ->label(fn (): string => __('messages.settings'))
                    ->url(fn (): string => route('profile.edit'))
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            // Language switcher in the top bar, using the SAME Blade partial as the Blade layout.
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn (): string => view('partials.language-switcher')->render(),
            )

            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                \Filament\Http\Middleware\DisableBladeIconComponents::class,
                \Filament\Http\Middleware\DispatchServingFilamentEvent::class,
                // Filament routes do NOT use Laravel's "web" middleware group, so the
                // language middleware must be added here too (after StartSession).
                SetLocale::class,
            ])
            ->authMiddleware([
                \Illuminate\Auth\Middleware\Authenticate::class,
            ]);
    }
}
