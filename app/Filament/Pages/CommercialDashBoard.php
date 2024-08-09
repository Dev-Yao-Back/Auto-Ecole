<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommercialDashBoard extends Page
{

  use AuthorizesRequests;

    protected static string $view = 'commercial.dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $slug = 'commercial-dash-board';

    protected static ?int $navigationSort = 0;

    public function mount()
    {
       $this->authorize('view', CommercialDashBoard::class);

        return Redirect::route('dashboard.commercial');
    }

    protected static function canView(): bool
    {
        // Using a gate here, but you could use a policy method if preferred
        return Gate::allows('view-commercial-dashboard');
    }


}