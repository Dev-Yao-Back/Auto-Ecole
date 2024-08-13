<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutoEcoleResource\Pages;
use App\Models\AutoEcole;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\CheckboxList;

class AutoEcoleResource extends Resource
{
    protected static ?string $model = AutoEcole::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nom'),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->label('Adresse'),

                TextInput::make('phone')
                    ->required()
                    ->maxLength(255)
                    ->label('Téléphone'),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Email'),

                CheckboxList::make('communes')
                    ->relationship('communes', 'nom_commune')
                    ->label('Communes de Résidence'),

                Textarea::make('description')
                    ->label('Description')
                    ->nullable(),            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Nom'),

                TextColumn::make('address')
                    ->label('Adresse'),

                TextColumn::make('phone')
                    ->label('Téléphone'),

                TextColumn::make('email')
                    ->label('Email'),

                TagsColumn::make('communes.nom_commune')->label('Communes de Résidence'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListAutoEcoles::route('/'),
            'create' => Pages\CreateAutoEcole::route('/create'),
            'edit' => Pages\EditAutoEcole::route('/{record}/edit'),
        ];
    }
}