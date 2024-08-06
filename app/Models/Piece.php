<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;
     protected $fillable =[
        'type_piece'
    ];


    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }
}