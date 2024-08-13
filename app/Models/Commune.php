<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes';

    protected $fillable = [
        'nom_commune',
    ];

    // Modèle Commune
    public function autoEcoles()
    {
        return $this->belongsToMany(AutoEcole::class, 'auto_ecole_commune');
    }

    public function scopeOfAutoEcole($query, $autoEcoleId)
    {
        return $query->where('auto_ecole_id', $autoEcoleId);
    }
}