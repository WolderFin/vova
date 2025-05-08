<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sity extends Model
{
    protected $fillable = ['name', 'in_city', 'url'];

    public function ads()
    {
        return $this->hasMany(Ad::class, 'city_id');
    }
}
