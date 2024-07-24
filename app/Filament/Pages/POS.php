<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class POS extends Page
{
  use AuthorizesRequests;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'POS';
    protected static ?string $slug = 'pos';
    protected static ?string $navigationGroup = 'Sales';
    protected static string $view = 'filament.pages.pos';

    public function mount()
    {
       $this->authorize('view', POS::class);

        return Redirect::route('pos');
    }
}