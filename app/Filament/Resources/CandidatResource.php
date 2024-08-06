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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use App\Models\CategorieModel as Categorie;
use App\Models\Statut;

class CandidatResource extends Resource
{
    protected static ?string $model = Candidat::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Sales';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('matricule')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('surname')->required(),
                Forms\Components\TextInput::make('tel_number1')->required(),
                Forms\Components\TextInput::make('tel_number2'),
                Forms\Components\TextInput::make('tel_number3'),
                Forms\Components\Select::make('sexe')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('date_birth')->required(),
                Forms\Components\TextInput::make('name_dad')->required(),
                Forms\Components\TextInput::make('name_moom')->required(),
                Forms\Components\TextInput::make('amont')->numeric()->required(),
                Forms\Components\Select::make('source_id')
                    ->relationship('sources', 'id')
                    ->required(),
                Forms\Components\Select::make('subvention_id')
                    ->relationship('subventions', 'lib_subvention')
                    ->required(),
                Forms\Components\Select::make('piece_id')
                    ->relationship('pieces', 'type_piece')
                    ->required(),
                Forms\Components\TextInput::make('lib_subvention')->required(),
                Forms\Components\TextInput::make('reste')->numeric()->required(),
                Forms\Components\Select::make('autre')
                    ->options([
                        'Deja inscrit ailleur' => 'Deja inscrit ailleur',
                        'pas encore inscrit' => 'pas encore inscrit',
                        'je ne sais' => 'je ne sais',

                    ])
                    ->required(),
                Forms\Components\TextInput::make('piece_rec')->required(),
                Forms\Components\TextInput::make('piece_ver')->required(),
                Forms\Components\TextInput::make('number_piece')->required(),
                Forms\Components\TextInput::make('categorie_permis')->required(),
                Forms\Components\TextInput::make('moyen_payement')->required(),

                Forms\Components\Select::make('statut_id')
                ->relationship('statut', 'type_statut')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('lib_statut')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('type_statut')
                        ->required()
                        ->maxLength(255),

                ])
                ->required(),
                Forms\Components\Toggle::make('is_visible')
                ->label('Visible')
                ->helperText('cliquer pour valider le candiat.')
                ->default(true)
                ->required(),
      ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('id')->sortable(),
              Tables\Columns\IconColumn::make('is_visible')
                    ->label('Validité')
                    ->sortable()
                    ->toggleable(),
              TextColumn::make('statut.type_statut')->sortable()->searchable()->toggleable(),
              TextColumn::make('name')->sortable()->searchable()->toggleable(),
              TextColumn::make('surname')->sortable()->searchable()->toggleable(),
              TextColumn::make('tel_number1')->sortable()->searchable()->toggleable(),
              TextColumn::make('sexe')->sortable()->searchable()->toggleable(),

              TextColumn::make('created_at')->dateTime()->toggleable(),            ])
            ->filters([
              SelectFilter::make('categorie_permis')
                ->options(Categorie::all()->pluck('type', 'id')) // Assurez-vous que la relation ou le champ existe
                ->label('Catégorie de Permis'),

            SelectFilter::make('statut_id')
                ->options(Statut::all()->pluck('type_statut', 'id')) // Utilisez le champ approprié
                ->label('Statut'),

            Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('start_date')->label('Date Start'),
                    Forms\Components\DatePicker::make('end_date')->label('Date End'),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query
                        ->when($data['start_date'], fn ($query, $start) => $query->whereDate('created_at', '>=', $start))
                        ->when($data['end_date'], fn ($query, $end) => $query->whereDate('created_at', '<=', $end));
                })
                ->label('Date de Création'),
              Tables\Filters\SelectFilter::make('statut_id')
              ->options([
                  '1' => 'Actif',
                  '2' => 'Inctif',


              ]),
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