<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'course_id',
        'status',
        'registration_date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
