@extends('layouts.master')

@section('title', 'Le nostre squadre')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Le nostre squadre </li>
@endsection

@section('body')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="{{ url('/img/Calcio/Open7.jpg') }}" class="card-img-top" alt="Open a 7">
                <div class="card-body">
                    <h5 class="card-title">F.lli Trentini</h5>
                    <p class="card-text">
                        Squadra iscritta al campionato Open a 7 del CSI Vallecamonica.
                        Rosa attuale:
                    <ul class="rosa">
                        <li>1 <span class="nomeCifra">Sabbadini Marco</span></li>
                        <li>5 <span class="nomeCifra">Sabbadini Manuel</span></li>
                        <li>6 <span class="nomeCifra">Chiodi Alessandro</span></li>
                        <li>19 <span class="nome">Savardi Giovanni ©</span></li>
                        <li>20 <span class="nome">Parolari Luca</span></li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="{{ url('/img/Calcio/Open6.jpg') }}" class="card-img-top" alt="Squadra B">
                <div class="card-body">
                    <h5 class="card-title">Squadra B</h5>
                    <p class="card-text">
                        La Squadra A è composta da giocatori esperti e giovani promesse. La rosa della squadra include:
                    <ul>
                        <li>Giovanni Rossi © </li>
                        <li>Mario Bianchi</li>
                        <li>Luca Verdi</li>

                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="{{ url('/img/Calcio/Ragazzi.jpg') }}" class="card-img-top" alt="Squadra C">
                <div class="card-body">
                    <h5 class="card-title">Squadra C</h5>
                    <p class="card-text">
                        La Squadra A è composta da giocatori esperti e giovani promesse. La rosa della squadra include:
                    <ul>
                        <li>Giovanni Rossi © </li>
                        <li>Mario Bianchi</li>
                        <li>Luca Verdi</li>

                    </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="{{ url('/img/Calcio/Bambini.jpg') }}" class="card-img-top" alt="Squadra D">
                <div class="card-body">
                    <h5 class="card-title">Squadra D</h5>
                    <p class="card-text">
                        La Squadra A è composta da giocatori esperti e giovani promesse. La rosa della squadra include:
                    <ul>
                        <li>Giovanni Rossi © </li>
                        <li>Mario Bianchi</li>
                        <li>Luca Verdi</li>

                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection