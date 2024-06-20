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
                    <h5 class="card-title">F.lli Trentini - Open a 7</h5>
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