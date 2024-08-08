<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $fillable = [
        'user_id',
        'referred_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
}