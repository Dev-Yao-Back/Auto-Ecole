<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    use HasFactory;
    protected $fillable = ['lib_statut','type_statut'];


    public function candidat()
    {
        return $this->hasMany(Candidat::class);
    }
}
