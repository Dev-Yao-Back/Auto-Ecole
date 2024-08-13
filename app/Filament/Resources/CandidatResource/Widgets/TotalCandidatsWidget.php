<?php

namespace App\Filament\Resources\CandidatResource\Widgets;

use Filament\Widgets\ChartWidget;

class TotalCandidatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    public $totalCandidats;

    protected function getData(): array
    {
        return [
        ];
    }

    protected function getType(): string
    {
        return 'bubble';
    }

    public function mount(): void
    {
        $this->totalCandidats = Candidat::where('auto_ecole_id', auth()->user()->auto_ecole_id)->count();
    }
}