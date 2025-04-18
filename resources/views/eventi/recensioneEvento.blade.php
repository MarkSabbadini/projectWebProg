@extends('layouts.master')

@section('title', 'Dettaglio recensioni')

@section('body')
<div class="container mt-5">
    <h2>{{ $evento->nome }}</h2>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</p>
    <p><strong>Descrizione:</strong> {{ $evento->descrizione }}</p>

    <hr>

    <h4 class="mt-4">Recensioni ({{ $evento->recensioni->count() }})</h4>

    @if($evento->recensioni->isEmpty())
        <p class="text-muted fst-italic">Nessuna recensione disponibile per questo evento.</p>
    @else
        @foreach($evento->recensioni as $recensione)
            <div class="border rounded p-3 mb-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>{{ $recensione->utente->nome }} {{ $recensione->utente->cognome }}</strong>
                    <span class="text-warning">{{ $recensione->voto }} ⭐</span>
                </div>
                <p class="mt-2 mb-1">{{ $recensione->commento }}</p>
                <small class="text-muted">Inviata il {{ $recensione->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @endforeach
    @endif

    <a href="{{ route('evento.recensioni.tutti') }}" class="btn btn-secondary mt-4">⬅️ Torna a elenco eventi</a>
</div>
@endsection
