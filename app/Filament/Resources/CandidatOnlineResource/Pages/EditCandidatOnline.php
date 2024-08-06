<?php

namespace App\Filament\Resources\CandidatOnlineResource\Pages;

use App\Filament\Resources\CandidatOnlineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandidatOnline extends EditRecord
{
    protected static string $resource = CandidatOnlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
