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
        'status',
        'piece_rec',
        'piece_ver',
        'number_piece',
        'categorie_permis',
        'moyen_payement',
    ];


    public function pieces()
    {
        return $this->belongsTo(Piece::class);
    }

    public function subventions()
    {
        return $this->belongsTo(Subvention::class);
    }

    public function sources()
    {
        return $this->belongsTo(Source::class);
    }
}


