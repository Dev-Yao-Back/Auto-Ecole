<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidatOnlineResource\Pages;
use App\Filament\Resources\CandidatOnlineResource\RelationManagers;
use App\Models\CandidatOnline;
use App\Models\CategorieModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Commune;

class CandidatOnlineResource extends Resource
{
    protected static ?string $model = CandidatOnline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          Forms\Components\TextInput::make('matricule')->disabled(),
          Forms\Components\TextInput::make('name')->required(),
          Forms\Components\TextInput::make('surname')->required(),
          Forms\Components\TextInput::make('email'),
          Forms\Components\TextInput::make('tel_number1')->required(),
          Forms\Components\Select::make('commune_residence')
              ->label('Commune de Résidence')
              ->options(Commune::pluck('nom_commune', 'id'))
              ->searchable()
              ->nullable(),
          Forms\Components\Select::make('sexe')->options([
              'male' => 'Male',
              'female' => 'Female',
          ])->required(),
          Forms\Components\DatePicker::make('date_birth'),
          Forms\Components\Select::make('categorie_permis_id')
              ->relationship('categoriePermis', 'type'),
          Forms\Components\TextInput::make('moyen_payement')->required(),
          Forms\Components\TextInput::make('promo_code'),
          Forms\Components\TextInput::make('name_dad'),
          Forms\Components\TextInput::make('name_mom'),
          Forms\Components\TextInput::make('number_piece')->required(),
          Forms\Components\TextInput::make('type_piece')->required(),
      ]);}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              Tables\Columns\TextColumn::make('matricule'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('surname'),
                Tables\Columns\TextColumn::make('tel_number1'),
                Tables\Columns\TextColumn::make('sexe'),
                Tables\Columns\TextColumn::make('date_birth')->date(),
                Tables\Columns\TextColumn::make('categoriePermis.type'),
                Tables\Columns\TextColumn::make('moyen_payement'),
                Tables\Columns\TextColumn::make('promo_code'),
                Tables\Columns\TextColumn::make('commune.nom_commune')->label('Commune de Résidence'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('commune_residence')
                    ->label('Commune de Résidence')
                    ->options(Commune::pluck('nom_commune', 'id')),
                Tables\Filters\SelectFilter::make('sexe')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])->label('Sexe'),
                Tables\Filters\SelectFilter::make('categorie_permis_id')->query(fn ($query) =>
                    $query->with('categoriePermis')->orderBy('type')
                )->options(CategorieModel::query()->pluck('type', 'id'))->label('Catégorie Permis'),
                Tables\Filters\SelectFilter::make('moyen_payement')->options([
                    'cash' => 'Cash',
                    'card' => 'Card',
                    'mobile_money' => 'Mobile Money',
                ])->label('Moyen de Paiement'),
                Tables\Filters\Filter::make('date_birth')->form([
                    Forms\Components\DatePicker::make('from')->placeholder('From Date'),
                    Forms\Components\DatePicker::make('to')->placeholder('To Date'),
                ])->query(function ($query, array $data) {
                    return $query->when($data['from'], fn ($query, $from) => $query->where('date_birth', '>=', $from))
                                 ->when($data['to'], fn ($query, $to) => $query->where('date_birth', '<=', $to));
                })->label('Date of Birth'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [      ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidatOnlines::route('/'),
            'create' => Pages\CreateCandidatOnline::route('/create'),
            'edit' => Pages\EditCandidatOnline::route('/{record}/edit'),
        ];
    }

    public static function getActions(): array
{
    return [
        Actions\Action::make('approve')
            ->label('Approve Registration')
            ->action(function (CandidatOnline $record) {
                $record->update(['status' => 'approved']);
            })
            ->color('success')
            ->icon('heroicon-s-check'),
    ];
}

public static function getNavigationGroup(): ?string
{
    return 'Sales';
}

public static function getNavigationLabel(): string
{
    return 'Candidats Online';
}
}