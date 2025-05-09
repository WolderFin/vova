<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'user_id',
        'ad_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с объявлением
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
