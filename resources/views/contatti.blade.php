@extends('layouts.master')

@section('title', 'CONTATTI')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Contatti</li>
@endsection

@section('body')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="mb-4">Info utili</h1>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Unione Sportiva Corteno Golgi A.S.D.</h5>
                    <p class="card-text mb-2">📍 Piazza Roma n°2, 25040 Corteno Golgi (BS)</p>
                    <p class="card-text mb-2">💼 Codice Fiscale: <code>IT 99 001 900 176</code></p>
                    <p class="card-text mb-2">🏦 IBAN: <code>IT07G0306954471100000004014</code></p>
                    <hr>
                    <p class="card-text mb-2">📞 <strong>Telefono:</strong> <a href="tel:+393427712982">342 77 12 982</a></p>
                    <p class="card-text mb-3">📧 <strong>Email:</strong> <a href="mailto:uscortenogolgi@gmail.com">uscortenogolgi@gmail.com</a></p>
                    <div class="mt-3">
                        <a href="https://www.instagram.com/u.s._cortenogolgi/" target="_blank" class="social-icon me-3">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://www.facebook.com/u.s._cortenogolgi/" target="_blank" class="social-icon">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
