<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/brand')->as('brand.')->group(function ()
{
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'showBrand'])->name('showBrand');
});

Route::prefix('/products')->as('product.')->group(function ()
{
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('detail');
});
