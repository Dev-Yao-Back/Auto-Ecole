<?php

namespace App\Filament\Resources\CandidatResource\Pages;

use App\Filament\Resources\CandidatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandidat extends EditRecord
{
    protected static string $resource = CandidatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
