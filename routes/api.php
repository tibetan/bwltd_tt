<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CountryMiddleware;
use App\Http\Controllers\BrandController;

Route::get('/brands', [BrandController::class, 'index'])->middleware(CountryMiddleware::class)->name('brands.fetch');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brand.create');
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brand.show');
Route::post('/brands', [BrandController::class, 'store'])->name('brand.store');
