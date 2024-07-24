<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
