<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommercialResource\Pages;
use App\Filament\Resources\CommercialResource\RelationManagers;
use App\Models\Commercial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;

use App\Models\User;


class CommercialResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sales';

    // Changez cette ligne pour renommer la ressource dans la navigation
    protected static ?string $navigationLabel = 'Commerciaux';



    public static function getEloquentQuery(): Builder
    {
        // Modifiez la requête par défaut pour inclure seulement les utilisateurs avec le rôle 'commercial'
        return static::$model::query()->whereHas('roles', function ($query) {
            $query->where('name', 'commerciaux');
        });
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              TextInput::make('name')->required(),
              TextInput::make('email')->required()->email(),
              TextInput::make('referral_code')->disabled(),
              Select::make('roles.name')
                  ->options([
                      'commercial' => 'Commercial',
                      'sous_commercial' => 'Sous Commercial',
                      'demarcheur' => 'Demarcheur',
                  ])->required(),            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('name'),
              TextColumn::make('email'),
              TextColumn::make('roles.name')->label('Roles')->sortable(),
              TextColumn::make('referral_code'),
              TextColumn::make('commissions.amount')->label('Total Commissions')
              ->formatStateUsing(function ($record) {
                  return $record->commissions->sum('amount');
              })
              ->sortable(),                          ])
            ->filters([

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
            'index' => Pages\ListCommercials::route('/'),
            'create' => Pages\CreateCommercial::route('/create'),
            'edit' => Pages\EditCommercial::route('/{record}/edit'),
        ];
    }
}