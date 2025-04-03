<?php

use App\Http\Controllers\CalcioController;
use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SquadraController;
use App\Http\Controllers\IscrizioneController;
use App\Http\Controllers\RadunoController;
use App\Http\Controllers\CaspolataController;
use App\Http\Controllers\UtenteController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Auth;




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
Route::delete('/evento/{id}', [EventoController::class, 'deleteEvento'])->name('evento.delete');
Route::get('/evento/{id}/edit', [EventoController::class, 'editEvento'])->name('evento.edit');
Route::put('/evento/{id}', [EventoController::class, 'updateEvento'])->name('evento.update');
Route::post('/evento', [EventoController::class, 'store'])->name('evento.store');

///////////////

Route::post('/iscrizione/submit', [IscrizioneController::class, 'submit'])->name('iscrizione.submit');


///////////////
Route::resource('calcio', CalcioController::class)->except('show');

Route::get('/calcio/risultati', [CalcioController::class, 'risultati'])->name('risultati');
Route::get('/calcio/torneo', [CalcioController::class, 'torneo'])->name('torneo');

Route::get('/calcio/squadre', [SquadraController::class, 'index'])->name('calcio.squadre');

///////// LOGIN E AREA RISERVATA

Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
Route::get('/ajaxUser', [AuthController::class, 'ajaxCheckForEmail']);


Route::middleware(['authCustom'])->group(function () {
    Route::get('/profilo', [UtenteController::class, 'index'])->name('profilo');

    Route::get('/profilo/create', [UtenteController::class, 'create'])->name('profilo.create');
    Route::post('/profilo', [UtenteController::class, 'store'])->name('profilo.store');

    Route::get('/profilo/edit', [UtenteController::class, 'edit'])->name('profilo.edit');
    Route::put('/profilo', [UtenteController::class, 'update'])->name('profilo.update');

    Route::get('/mie-iscrizioni', [UtenteController::class, 'mieIscrizioni'])->name('iscrizione.submit');
});



















