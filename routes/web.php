<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/admin', [IndexController::class, 'admin'])->name('admin')->middleware('auth');

Route::get('/admin/categories', [CategoryController::class, 'category'])->name('category')->middleware('auth');
Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::get('/admin/ads', [AdController::class, 'ads'])->name('ads')->middleware('auth');
Route::delete('/admin/ads/delete/{id}', [AdController::class, 'delete'])->name('ads.delete');



Route::get('/account', [IndexController::class, 'account'])->name('account')->middleware('auth');



Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/cities', [CityController::class, 'sities'])->name('cities');
Route::delete('/cities/{id}', [CityController::class, 'delete'])->name('cities.delete');
Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
Route::post('/cities/create', [CityController::class, 'create'])->name('cities.create');
