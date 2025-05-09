<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Sity;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Загружаем все настройки
        $GlobalCategory = Category::all();
        $GlobalCity = Sity::all();

        // Делаем доступными в Blade-шаблонах
        View::share('globalCategory', $GlobalCategory);
        View::share('globalCity', $GlobalCity);
    }
}
