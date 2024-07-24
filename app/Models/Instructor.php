<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
