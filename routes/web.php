<?php

use App\Http\Controllers\CalcioController;
use App\Http\Controllers\CaspolataController;
use App\Http\Controllers\RadunoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;


Route::get('/', [FrontController::class, 'getHome'])->name('home'); // V

Route::get('/storia', [FrontController::class, 'getStoria'])->name('storia');

Route::get('/direttivo', [FrontController::class, 'getDirettivo'])->name('direttivo');

Route::get('/contatti', [FrontController::class, 'getContatti'])->name('contatti');

////////////////
Route::resource('caspolata', CaspolataController::class);

Route::get('/eventi/caspolata/iscrizioneCaspolata', [CaspolataController::class, 'getIscrizioneCaspolata'])->name('iscrizioneCaspolata');

////////////////
Route::resource('raduno', RadunoController::class);

Route::get('/eventi/raduno/iscrizioneRadunoSingolo', [RadunoController::class, 'getIscrizioneRadunoSingolo'])->name('iscrizioneRadunoSingolo');
Route::get('/eventi/raduno/iscrizioneRadunoGruppo', [RadunoController::class, 'getIscrizioneRadunoGruppo'])->name('iscrizioneRadunoGruppo');

////////////////
Route::resource('calcio', CalcioController::class);













