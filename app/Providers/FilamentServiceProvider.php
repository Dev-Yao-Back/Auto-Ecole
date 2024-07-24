<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filament\Pages\POS;
use Filament\Facades\Filament;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      Filament::serving(function () {
        Filament::registerNavigationItems([
            Filament::navItem()
                ->label('POS')
                ->icon('heroicon-o-credit-card')
                ->url(route('filament.pages.pos'))
                ->group('Sales')
                ->sort(1),
        ]);
    });

    Filament::registerPages([
        POS::class,
    ]);    }
}
