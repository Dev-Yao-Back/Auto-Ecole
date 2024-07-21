<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationModel extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $fillable = ['name', 'email', 'phone', 'amount'];
}
