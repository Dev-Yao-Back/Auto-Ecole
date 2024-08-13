<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          TextInput::make('name')
              ->required()
              ->maxLength(255),
          TextInput::make('email')
              ->required()
              ->email()
              ->maxLength(255),
              TextInput::make('password')
              ->password()
              ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
              ->required(fn ($record) => !$record) // Requis seulement lors de la création
              ->minLength(8)
              ->maxLength(255)
              ->dehydrated(fn ($state) => filled($state)), // Assurez-vous que le champ n'est pas vide avant de hacher
          Select::make('roles')
              ->relationship('roles', 'name')
              ->multiple(),
              Select::make('auto_ecole_id')
                    ->relationship('autoEcole', 'name')
                    ->required()
                    ->label('Auto École'),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('roles.name')->label('Roles')->sortable(),
                TextColumn::make('autoEcole.name')
                    ->label('Auto École'),

            ])
            ->filters([
              SelectFilter::make('auto_ecole_id')
              ->label('Auto École')
              ->relationship('autoEcole', 'name'),            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}