<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';
    protected static ?string $navigationGroup = 'Learning';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          Forms\Components\Select::make('candidate_id')
              ->relationship('candidate', 'name')
              ->required(),
          Forms\Components\Select::make('course_id')
              ->relationship('course', 'name')
              ->required(),
          Forms\Components\TextInput::make('status')->required(),
          Forms\Components\DatePicker::make('registration_date')->required(),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('id')->sortable(),
              TextColumn::make('candidate.name')->sortable()->searchable(),
              TextColumn::make('course.name')->sortable()->searchable(),
              TextColumn::make('status')->sortable()->searchable(),
              TextColumn::make('registration_date')->date(),
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
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }
}