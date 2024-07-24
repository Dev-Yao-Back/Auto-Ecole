<?php

namespace App\Filament\Resources\GateWayResource\Pages;

use App\Filament\Resources\GateWayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGateWays extends ListRecords
{
    protected static string $resource = GateWayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
