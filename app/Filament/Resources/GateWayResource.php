<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GateWayResource\Pages;
use App\Filament\Resources\GateWayResource\RelationManagers;
use App\Models\GateWay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class GateWayResource extends Resource
{
    protected static ?string $model = GateWay::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Forms\Components\TextInput::make('name')->required()->maxLength(255),
              Forms\Components\Textarea::make('description')->maxLength(500),
              Forms\Components\TextInput::make('api_key')->required()->maxLength(255),
              Forms\Components\TextInput::make('api_secret')->required()->maxLength(255),
              Forms\Components\Toggle::make('status')->required(),            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('id')->sortable(),
              TextColumn::make('name')->sortable()->searchable(),
              TextColumn::make('description')->sortable()->searchable(),
              TextColumn::make('api_key')->sortable()->searchable(),
              TextColumn::make('api_secret')->sortable()->searchable(),
              TextColumn::make('status')->sortable()->searchable(),
              TextColumn::make('created_at')->dateTime(),            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGateWays::route('/'),
            'create' => Pages\CreateGateWay::route('/create'),
            'edit' => Pages\EditGateWay::route('/{record}/edit'),
        ];
    }
}