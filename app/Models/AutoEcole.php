<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoEcole extends Model
{
    use HasFactory;

    // Les attributs que l'on peut assigner en masse
    protected $fillable = [
      'name',
      'address',
      'phone',
      'email',
      'logo',
      'commune',
      'description',
  ];

  /**
   * Relations avec les utilisateurs de l'auto-école.
   */
  public function users()
  {
      return $this->hasMany(User::class, 'auto_ecole_id');
  }

  /**
   * Relations avec les candidats de l'auto-école.
   */
  public function candidats()
  {
      return $this->hasMany(Candidat::class);
  }

  /**
   * Relations avec les communes couvertes par l'auto-école.
   */
  // Dans le modèle AutoEcole
  public function communes()
  {
      return $this->belongsToMany(Commune::class, 'auto_ecole_commune');
  }

  /**
   * Relations avec les écoles de l'auto-école.
   */

public function candidatOnlines()
  {
      return $this->hasMany(CandidatOnline::class);
  }

}