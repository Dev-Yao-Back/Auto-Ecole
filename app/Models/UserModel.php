<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'phone',
        'uniue_link',
        'referral_count'= 0
    ];

    public function generateUniqueLink()
    {
        $this->unique_link = $this->createUniqueLink();
        $this->save();
    }

    protected function createUniqueLink()
    {
        do {
            $link = Str::random(10);
        } while (self::where('unique_link', $link)->exists());

        return $link;
}
}
