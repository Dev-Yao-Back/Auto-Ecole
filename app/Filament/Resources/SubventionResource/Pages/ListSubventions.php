<?php

namespace App\Filament\Resources\SubventionResource\Pages;

use App\Filament\Resources\SubventionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubventions extends ListRecords
{
    protected static string $resource = SubventionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
