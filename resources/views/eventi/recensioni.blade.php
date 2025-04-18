@extends('layouts.master')

@section('title', 'Recensioni Eventi')

@section('body')
<div class="container mt-5">
    <h2 class="mb-4">Recensioni eventi passati</h2>

    @if($caspolate->isEmpty() && $raduni->isEmpty())
        <p class="text-muted">Nessun evento disponibile.</p>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h4 class="mb-3">Caspolata</h4>
            @foreach($caspolate as $evento)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nome }}</h5>
                        <p class="card-text mb-1"><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</p>
                        <p class="card-text mb-2">
                            <strong>Media voto:</strong>
                            {{ $evento->recensioni->avg('voto') ? number_format($evento->recensioni->avg('voto'), 1) . ' ⭐' : 'Nessuna recensione' }}
                        </p>
                        <a href="{{ route('evento.recensioni.dettaglio', ['id' => $evento->id]) }}" class="btn btn-outline-primary btn-sm">
                            📋 Vedi recensioni
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        
        <div class="col-md-6">
            <h4 class="mb-3">Raduno</h4>
            @foreach($raduni as $evento)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nome }}</h5>
                        <p class="card-text mb-1"><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</p>
                        <p class="card-text mb-2">
                            <strong>Media voto:</strong>
                            {{ $evento->recensioni->avg('voto') ? number_format($evento->recensioni->avg('voto'), 1) . ' ⭐' : 'Nessuna recensione' }}
                        </p>
                        <a href="{{ route('evento.recensioni.dettaglio', ['id' => $evento->id]) }}" class="btn btn-outline-primary btn-sm">
                            📋 Vedi recensioni
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
