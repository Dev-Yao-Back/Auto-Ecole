<?php

namespace App\Filament\Resources\SubventionResource\Pages;

use App\Filament\Resources\SubventionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubvention extends EditRecord
{
    protected static string $resource = SubventionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
