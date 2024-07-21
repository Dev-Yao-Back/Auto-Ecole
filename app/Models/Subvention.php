<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subvention extends Model
{
    use HasFactory;
     protected $fillable =[
      'lib_subvention',
        'type_subvention'
    ];


    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }
}
