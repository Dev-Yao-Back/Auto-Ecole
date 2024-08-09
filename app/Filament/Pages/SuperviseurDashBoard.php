<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuperviseurDashBoard extends Page
{
  use AuthorizesRequests;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.superviseur-dash-board';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $slug = 'superviseur-dash-board';

    protected static ?int $navigationSort = 0;

    public function mount()
    {
       $this->authorize('view', SuperviseurDashBoard::class);

        return Redirect::route('dashboard.superviseur');
    }
}
