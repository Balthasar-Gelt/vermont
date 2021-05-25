<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['lang'])->group(function () {
  
    require __DIR__.'/auth.php';

    Route::resource('products', ProductController::class)->middleware(['auth']);
});

Route::get('lang/{lang}', [LanguageController::class, 'change'])->name('lang');