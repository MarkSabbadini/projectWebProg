<?php

use App\Http\Controllers\CalcioController;
use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SquadraController;
use App\Http\Controllers\IscrizioneController;
use App\Http\Controllers\RadunoController;
use App\Http\Controllers\CaspolataController;




Route::get('/', [FrontController::class, 'getHome'])->name('home'); // V

Route::get('/storia', [FrontController::class, 'getStoria'])->name('storia');

Route::get('/direttivo', [FrontController::class, 'getDirettivo'])->name('direttivo');

Route::get('/contatti', [FrontController::class, 'getContatti'])->name('contatti');

////////////////

Route::get('/caspolata', [CaspolataController::class, 'index'])->name('caspolata.index');
Route::get('/iscrizione/caspolata/{evento}', [IscrizioneController::class, 'formCaspolata'])->name('caspolata.iscrizione');

////////////////

Route::get('/raduno', [RadunoController::class, 'index'])->name('raduno.index');
Route::get('/iscrizione/raduno/{evento}', [IscrizioneController::class, 'formRaduno'])->name('raduno.iscrizione');


///////////////

Route::get('/evento/crea', [EventoController::class, 'create'])->name('evento.create');
Route::post('/evento', [EventoController::class, 'store'])->name('evento.store');

///////////////

Route::post('/iscrizione/submit', [IscrizioneController::class, 'submit'])->name('iscrizione.submit');


///////////////
Route::resource('calcio', CalcioController::class)->except('show');

Route::get('/calcio/risultati', [CalcioController::class, 'risultati'])->name('risultati');
Route::get('/calcio/torneo', [CalcioController::class, 'torneo'])->name('torneo');

Route::get('/calcio/squadre', [SquadraController::class, 'index'])->name('calcio.squadre');
















