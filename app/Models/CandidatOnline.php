<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatOnline extends Model
{
    use HasFactory;

    protected $table = 'candidat_onlines';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'tel_number1',
        'sexe',
        'date_birth',
        'commune_residence',
        'auto_ecole_id',
        'categorie_permis_id',
        'subvention_id',
        'moyen_payement',
        'promo_code',
        'name_dad',
        'name_mom',
        'number_piece',
        'type_piece',  // Type de pièce d'identité
    ];

    protected $casts = [
        'date_birth' => 'datetime',
    ];

    /**
     * Génère un matricule unique pour le candidat lors de l'inscription.
     */
    protected static function boot()
    {
        static::creating(function ($candidat) {
            $candidat->auto_ecole_id = $candidat->autoEcoleByCommune() ?: 1;
        });

        static::updating(function ($candidat) {
            $candidat->auto_ecole_id = $candidat->autoEcoleByCommune() ?: 1;
        });

        parent::boot();
        static::creating(function ($candidat) {
            $candidat->matricule = 'CDT-'.time(); // Exemple de génération de matricule
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


    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_residence');
    }

    public function categoriePermis()
    {
        return $this->belongsTo(CategorieModel::class, 'categorie_permis_id');
    }

    public function pieces()
    {
        return $this->belongsTo(Piece::class, 'piece_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'registration_id');
    }

    public function subvention()
    {
        return $this->belongsTo(Subvention::class, 'subvention_id');
    }

    public function getDate()
    {
        return $this->date_birth->format('d/m/Y');
    }

    public function getTime()
    {
        return $this->date_birth->format('H:i');
    }

    public function autoEcole()
    {
        return $this->belongsTo(AutoEcole::class);
    }
}