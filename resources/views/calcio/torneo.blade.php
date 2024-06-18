@extends('layouts.master')

@section('title', 'Torneo Estivo 2024')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Torneo estivo 2024</li>
@endsection

@section('body')

<div class="container mt-5">
        <h2>TORNEO ESTIVO 2025</h2>
        <p>
            Torneo estivo 2024
            Organizzato dal Centro sportivo san martino in collaborazione con l'U.S. Corteno Golgi
        </p>

    </div>

    <div class="col-md-4">
            <img src="{{ asset('img/torneo.jpg') }}" class="img-fluid" alt="Torneo Estivo 2025">
        </div>
@endsection