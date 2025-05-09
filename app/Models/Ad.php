<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'user_id',
        'category_id',
        'city_id',
        'url',
        'status',
    ];

    // Метод для связи с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Метод для связи с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Метод для связи с городом (Sity)
    public function city()
    {
        return $this->belongsTo(Sity::class, 'city_id'); // Указываем правильное имя поля (city_id)
    }
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}
