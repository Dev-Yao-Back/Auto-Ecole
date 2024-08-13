<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieModel extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['type
    '];

    public function scopeOfAutoEcole($query, $autoEcoleId)
    {
        return $query->where('auto_ecole_id', $autoEcoleId);
    }

  }