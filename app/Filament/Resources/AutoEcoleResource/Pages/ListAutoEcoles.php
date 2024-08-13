<?php

namespace App\Filament\Resources\AutoEcoleResource\Pages;

use App\Filament\Resources\AutoEcoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAutoEcoles extends ListRecords
{
    protected static string $resource = AutoEcoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
