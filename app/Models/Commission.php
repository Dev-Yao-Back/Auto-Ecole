<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'commissions';

    protected $fillable = [
        'user_id',
        'amount',
        'level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfAutoEcole($query, $autoEcoleId)
{
    return $query->where('auto_ecole_id', $autoEcoleId);
}

}