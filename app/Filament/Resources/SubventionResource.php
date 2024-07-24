<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubventionResource\Pages;
use App\Filament\Resources\SubventionResource\RelationManagers;
use App\Models\Subvention;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class SubventionResource extends Resource
{
    protected static ?string $model = Subvention::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationGroup = 'Partner';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          Forms\Components\TextInput::make('lib_subvention')
              ->required()
              ->maxLength(255),
          Forms\Components\TextInput::make('type_subvention')
              ->required()
              ->maxLength(255),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('id')->sortable(),
              TextColumn::make('lib_subvention')->sortable()->searchable(),
              TextColumn::make('type_subvention')->sortable()->searchable(),
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
            'index' => Pages\ListSubventions::route('/'),
            'create' => Pages\CreateSubvention::route('/create'),
            'edit' => Pages\EditSubvention::route('/{record}/edit'),
        ];
    }
}