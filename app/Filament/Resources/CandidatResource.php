<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidatResource\Pages;
use App\Filament\Resources\CandidatResource\RelationManagers;
use App\Models\Candidat;
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
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use App\Models\CategorieModel ;
use App\Models\Subvention;
use App\Models\Statut;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class CandidatResource extends Resource
{
    protected static ?string $model = Candidat::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Sales';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          TextInput::make('matricule')->required(),
          TextInput::make('name')->required(),
          TextInput::make('surname')->required(),
          TextInput::make('tel_number1')->tel(),
          TextInput::make('tel_number2')->tel(),
          TextInput::make('tel_number3')->tel(),
          Select::make('sexe')
              ->options([
                  'male' => 'Male',
                  'female' => 'Female',
              ])->required(),
          DatePicker::make('date_birth')->required(),
          TextInput::make('name_dad'),
          TextInput::make('name_moom'),
          TextInput::make('amont')->numeric(),
          TextInput::make('promo_code'),
          Forms\Components\BelongsToSelect::make('subvention_id')->relationship('subventions', 'id'),
          Forms\Components\BelongsToSelect::make('piece_id')->relationship('pieces', 'id'),
          TextInput::make('lib_subvention'),
          TextInput::make('reste')->numeric(),
          TextInput::make('autre'),
          Forms\Components\FileUpload::make('piece_rec')->image(),
          Forms\Components\FileUpload::make('piece_ver')->image(),
          TextInput::make('number_piece'),
          Select::make('categorie_permis')->options([
              'A' => 'Catégorie A',
              'B' => 'Catégorie B',
              'C' => 'Catégorie C',
          ])->required(),
          Select::make('moyen_payement')->options([
              'cash' => 'Cash',
              'card' => 'Card',
              'check' => 'Check',
          ]),
          Forms\Components\BelongsToSelect::make('statut_id')->relationship('statut', 'id'),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('statut.type_statut')->sortable()->searchable()->toggleable(),
              TextColumn::make('matricule')->searchable()->sortable()->label('Matricule'),
            TextColumn::make('name')->searchable()->sortable()->label('Prénom'),
            TextColumn::make('surname')->searchable()->sortable()->label('Nom de famille'),
            TextColumn::make('tel_number1')->searchable()->label('Téléphone'),
//            TextColumn::make('date_birth')->date()->sortable()->label('Date de naissance'),
            BadgeColumn::make('sexe')->colors([
                'male' => 'blue',
                'female' => 'pink',
            ]),
            TextColumn::make('category.type')
            ->label('Categorie')
            ->sortable()  // Only if the underlying database relation supports it and you have configured it properly
            ->searchable(),
            TextColumn::make('subventions.lib_subvention')
            ->label('Subvention')
            ->sortable()  // Only if the underlying database relation supports it and you have configured it properly
            ->searchable(),            TextColumn::make('amont')->money('xof'),
            // Other columns as needed
        ])
       ->filters([
          // Gender Filter
          SelectFilter::make('sexe')
              ->options([
                  'male' => 'Male',
                  'female' => 'Female',
              ])
              ->label('Gender'),

          // Status Filter
          SelectFilter::make('statut.type_statut')
              ->options([
                  'Actif' => 'Actif',
                  'Inactif' => 'Inactif',
              ])
              ->label('Status'),

          // Category Permit Filter
          SelectFilter::make('categorie_permis_id')
              ->query(function ($query) {
                  return $query->orderBy('type'); // Assuming 'type' is the correct field to order by
              })
              ->options(CategorieModel::query()->pluck('type', 'type'))
              ->label('Catégorie Permis'),

          // Subvention Filter
          SelectFilter::make('subventions.lib_subvention')
              ->query(function ($query) {
                  return $query->orderBy('lib_subvention');
              })
              ->options(Subvention::query()->pluck('lib_subvention', 'id'))
              ->label('Subvention'),

          // Date Range Filter
          Filter::make('created_at')
              ->form([
                  Forms\Components\DatePicker::make('start_date')
                      ->label('Date Start'),
                  Forms\Components\DatePicker::make('end_date')
                      ->label('Date End'),
              ])
              ->query(function (Builder $query, array $data) {
                  return $query
                      ->when($data['start_date'], fn ($query, $start) => $query->whereDate('created_at', '>=', $start))
                      ->when($data['end_date'], fn ($query, $end) => $query->whereDate('created_at', '<=', $end));
              })
              ->label('Date de Création'),
      ])
        ->actions([
            ViewAction::make(),
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
          ExportBulkAction::make(),
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCandidats::route('/'),
            'create' => Pages\CreateCandidat::route('/create'),
            'edit' => Pages\EditCandidat::route('/{record}/edit'),
        ];
    }

    public static function rules(): array
    {
        return [
            'is_visible' => 'required|boolean',
        ];
    }


}