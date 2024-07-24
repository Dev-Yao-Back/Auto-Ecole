<?php

namespace App\Filament\Resources\GateWayResource\Pages;

use App\Filament\Resources\GateWayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGateWay extends EditRecord
{
    protected static string $resource = GateWayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
