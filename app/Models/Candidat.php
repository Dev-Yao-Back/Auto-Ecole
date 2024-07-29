<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'name',
        'surname',
        'tel_number1',
        'tel_number2',
        'tel_number3',
        'sexe',
        'date_birth',
        'name_dad',
        'name_moom',
        'amont',
        'source_id',
        'subvention_id',
        'piece_id',
        'lib_subvention',
        'reste',
        'autre',
        'piece_rec',
        'piece_ver',
        'number_piece',
        'categorie_permis',
        'moyen_payement',
        'statut_id'
    ];


    public function pieces()
    {
        return $this->belongsTo(Piece::class,'piece_id');
    }

    public function subventions()
    {
        return $this->belongsTo(Subvention::class,'subvention_id');
    }

    public function sources()
    {
        return $this->belongsTo(Source::class,'source_id');
    }
    public function statut()
    {
        return $this->belongsTo(Statut::class,'statut_id');
    }
}


