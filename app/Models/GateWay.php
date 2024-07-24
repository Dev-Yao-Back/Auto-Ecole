<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateWay extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'api_key',
        'api_secret',
        'status',
    ];
}
