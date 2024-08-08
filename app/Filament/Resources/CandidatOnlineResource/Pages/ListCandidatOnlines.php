<?php

namespace App\Filament\Resources\CandidatOnlineResource\Pages;

use App\Filament\Resources\CandidatOnlineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCandidatOnlines extends ListRecords
{
    protected static string $resource = CandidatOnlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}