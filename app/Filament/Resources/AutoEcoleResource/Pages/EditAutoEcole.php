<?php

namespace App\Filament\Resources\AutoEcoleResource\Pages;

use App\Filament\Resources\AutoEcoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutoEcole extends EditRecord
{
    protected static string $resource = AutoEcoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
