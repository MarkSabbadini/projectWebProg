<?php

use App\Http\Controllers\CalcioController;
use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SquadraController;



Route::get('/', [FrontController::class, 'getHome'])->name('home'); // V

Route::get('/storia', [FrontController::class, 'getStoria'])->name('storia');

Route::get('/direttivo', [FrontController::class, 'getDirettivo'])->name('direttivo');

Route::get('/contatti', [FrontController::class, 'getContatti'])->name('contatti');

Route::get('/eventi/creaEvento', [FrontController::class, 'getCreaEvento'])->name('creaEvento');

////////////////

Route::get('/caspolata', [EventoController::class, 'caspolataIndex'])->name('caspolata.index');
Route::get('/caspolata/iscrizioneCaspolata', [EventoController::class, 'iscrizioneCaspolata'])->name('caspolata.iscrizione');

////////////////

Route::get('/raduno', [EventoController::class, 'radunoIndex'])->name('raduno.index');
Route::get('/raduno/iscrizioneRaduno', [EventoController::class, 'iscrizioneRaduno'])->name('raduno.iscrizione');


////////////////

Route::get('/evento/crea', [EventoController::class, 'create'])->name('evento.create');
Route::post('/evento', [EventoController::class, 'store'])->name('evento.store');


///////////////
Route::resource('calcio', CalcioController::class)->except('show');

Route::get('/calcio/risultati', [CalcioController::class, 'risultati'])->name('risultati');
Route::get('/calcio/torneo', [CalcioController::class, 'torneo'])->name('torneo');

Route::get('/calcio/squadre', [SquadraController::class, 'index'])->name('calcio.squadre');
















