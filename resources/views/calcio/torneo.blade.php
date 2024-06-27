@extends('layouts.master')

@section('title', 'Torneo Estivo 2024')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Torneo estivo 2024</li>
@endsection

@section('body')

<div class="container mt-4">
    <p>
        Il torneo a 6 giocatori organizzato dal Centro sportivo San Martino in collaborazione con l'U.S. Corteno Golgi
        giunge quest'anno alla sua
        12^ edizione.
        Il torneo inizierà Martedì 9 Luglio, le finali saranno Venerdì 9 Agosto, durante tutte le serate sarà attivo il
        servizio bar e cucina.
        Vi aspettiamo come sempre numerosi!
        Per info ed iscrizioni contattare il Centro sportivo: cellulare o tramite social network
        <a href="https://www.instagram.com/centrosportivocortenogolgi/" target="_blank" class="social-icon"><i
                class="bi bi-instagram"></i></a>
        <a href="https://www.facebook.com/CentroSportivoSanMartinoCortenoGolgi/?locale=it_IT" target="_blank"
            class="social-icon"><i class="bi bi-facebook"></i></a>


    </p>

</div>

<div class="col-md-4">
    <img src="{{ asset('img/Calcio/torneo.jpg') }}" class="img-fluid" alt="Torneo Estivo 2025">
</div>
@endsection