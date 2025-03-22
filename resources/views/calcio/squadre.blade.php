@extends('layouts.master')

@section('title', 'Le nostre squadre')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Le nostre squadre</li>
@endsection

@section('body')
<div class="container mt-4">
    <div class="row">
        @forelse ($squadre as $squadra)
            <div class="col-md-6">
                <div class="card mb-4">
                    {{-- Immagine placeholder (puoi personalizzarla con logica in base al nome squadra) --}}
                    <img src="{{ url('/img/Calcio/Open7.jpg') }}" class="card-img-top" alt="{{ $squadra->nome }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $squadra->nome }}</h5>
                        <p class="card-text">
                            Rosa attuale:
                        </p>
                        <ul class="rosa">
                            @forelse ($squadra->calciatori as $calciatore)
                                <li>
                                    {{ $calciatore->numero }}
                                    <span class="nomeCifra">{{ $calciatore->nome }} {{ $calciatore->cognome }}</span>
                                </li>
                            @empty
                                <li><em>Nessun calciatore registrato</em></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nessuna squadra disponibile al momento.</p>
        @endforelse
    </div>
</div>
@endsection
