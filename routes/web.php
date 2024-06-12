<?php

use App\Http\Controllers\CaspolataController;
use App\Http\Controllers\RadunoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;


Route::get('/', [FrontController::class, 'getHome'])->name('home'); // V

Route::get('/storia', [FrontController::class, 'getStoria'])->name('storia');

Route::get('/direttivo', [FrontController::class, 'getDirettivo'])->name('direttivo');

Route::get('/contatti', [FrontController::class, 'getContatti'])->name('contatti');

Route::resource('caspolata', CaspolataController::class);

Route::resource('raduno', RadunoController::class);







