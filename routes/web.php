<?php

use App\Http\Controllers\CalcioController;
use App\Http\Controllers\CaspolataController;
use App\Http\Controllers\RadunoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SquadraController;



Route::get('/', [FrontController::class, 'getHome'])->name('home'); // V

Route::get('/storia', [FrontController::class, 'getStoria'])->name('storia');

Route::get('/direttivo', [FrontController::class, 'getDirettivo'])->name('direttivo');

Route::get('/contatti', [FrontController::class, 'getContatti'])->name('contatti');

Route::get('/eventi/creaEvento', [FrontController::class, 'getCreaEvento'])->name('creaEvento');

////////////////
Route::resource('caspolata', CaspolataController::class);

Route::get('/eventi/caspolata/iscrizioneCaspolata', [CaspolataController::class, 'getIscrizioneCaspolata'])->name('iscrizioneCaspolata');

////////////////
Route::resource('raduno', RadunoController::class);

Route::get('/eventi/raduno/iscrizioneRadunoSingolo', [RadunoController::class, 'getIscrizioneRadunoSingolo'])->name('iscrizioneRadunoSingolo');

////////////////



///////////////
Route::resource('calcio', CalcioController::class)->except('show');

Route::get('/calcio/risultati', [CalcioController::class, 'risultati'])->name('risultati');
Route::get('/calcio/torneo', [CalcioController::class, 'torneo'])->name('torneo');

Route::get('/calcio/squadre', [SquadraController::class, 'index'])->name('calcio.squadre');
















