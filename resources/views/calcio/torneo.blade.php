@extends('layouts.master')

@section('title', 'Torneo Estivo 2024')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Torneo Estivo 2024</li>
@endsection

@section('body')
<div class="container my-5">
    <div class="row align-items-center">
        <!-- Testo -->
        <div class="col-md-8 mb-4 mb-md-0">
            <h1 class="mb-3">12ª Edizione – Torneo Estivo 2025</h1>
            <p class="lead">
                Il torneo a 6 giocatori organizzato dal <strong>Centro sportivo San Martino</strong>, in collaborazione con 
                <strong>U.S. Corteno Golgi</strong>, giunge quest'anno alla sua dodicesima edizione.
            </p>
            <p>
                <strong>Inizio:</strong> Martedì 9 Luglio<br>
                <strong>Finali:</strong> Venerdì 9 Agosto
            </p>
            <p>
                Durante tutte le serate sarà attivo il servizio <strong>bar e cucina</strong>.
            </p>
            <p class="mb-3">
                Vi aspettiamo come sempre numerosi!
            </p>
            <p>
                📞 <strong>Per info e iscrizioni:</strong> contatta il Centro Sportivo via cellulare o tramite social:
                <br>
                <a href="https://www.instagram.com/centrosportivocortenogolgi/" target="_blank" class="social-icon me-2">
                    <i class="bi bi-instagram fs-4"></i>
                </a>
                <a href="https://www.facebook.com/CentroSportivoSanMartinoCortenoGolgi/?locale=it_IT" target="_blank"
                    class="social-icon">
                    <i class="bi bi-facebook fs-4"></i>
                </a>
            </p>
        </div>

        <!-- Immagine -->
        <div class="col-md-4 text-center">
            <img src="{{ asset('img/Calcio/torneo.jpg') }}" class="img-fluid rounded shadow-sm" alt="Torneo Estivo 2024">
        </div>
    </div>
</div>
@endsection
