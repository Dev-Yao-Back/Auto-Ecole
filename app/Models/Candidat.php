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
        'promo_code',
        'subvention_id',
        'piece_id',
        'lib_subvention',
        'auto_ecole_id',
        'commune_residence',
        'reste',
        'autre',
        'piece_rec',
        'piece_ver',
        'number_piece',
        'categorie_permis',
        'moyen_payement',
        'statut_id',

    ];

    protected static function booted()
    {
        static::creating(function ($candidat) {
            $candidat->auto_ecole_id = $candidat->autoEcoleByCommune() ?: 1;
        });

        static::updating(function ($candidat) {
            $candidat->auto_ecole_id = $candidat->autoEcoleByCommune() ?: 1;
        });
    }

    public function autoEcoleByCommune()
    {
    if ($this->commune_residence) {
        $commune = Commune::with('autoEcoles')->find($this->commune_residence);
        \Log::info('Auto-écoles liées à la commune:', ['Auto-Écoles' => $commune->autoEcoles->pluck('name')]);
        if ($commune && $commune->autoEcoles->isNotEmpty()) {
            return $commune->autoEcoles->first()->id;
        }
    }
    return null;
}

    // Définir les relations avec Commune et AutoEcole
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }


    public function pieces()
    {
        return $this->belongsTo(Piece::class,'piece_id');
    }

    public function subventions()
    {
        return $this->belongsTo(Subvention::class,'subvention_id');
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class,'statut_id');
    }

    public function category()
    {
        return $this->belongsTo(CategorieModel::class,'categorie_permis');
    }

    public function autoEcole()
{
    return $this->belongsTo(AutoEcole::class);
}
public function scopeOfAutoEcole($query, $autoEcoleId)
{
    return $query->where('auto_ecole_id', $autoEcoleId);
}


}