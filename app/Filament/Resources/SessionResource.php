<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionResource\Pages;
use App\Filament\Resources\SessionResource\RelationManagers;
use App\Models\Session;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class SessionResource extends Resource
{
    protected static ?string $model = Session::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Learning';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Forms\Components\Select::make('course_id')
              ->relationship('course', 'name')
              ->required(),
          Forms\Components\Select::make('instructor_id')
              ->relationship('instructor', 'name')
              ->required(),
          Forms\Components\DatePicker::make('date')->required(),
          Forms\Components\TimePicker::make('start_time')->required(),
          Forms\Components\TimePicker::make('end_time')->required(),            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('id')->sortable(),
              TextColumn::make('course.name')->sortable()->searchable(),
              TextColumn::make('instructor.name')->sortable()->searchable(),
              TextColumn::make('date')->date()->sortable()->searchable(),
              TextColumn::make('start_time')->time(),
              TextColumn::make('end_time')->time(),
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
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSession::route('/create'),
            'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }
}