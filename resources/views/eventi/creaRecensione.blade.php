@extends('layouts.master')

@section('title', 'Scrivi una Recensione')

@section('body')
    <div class="container mt-5">
        <h2>Recensione per: {{ $evento->nome }}</h2>
        <p><strong>Data evento:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</p>

        <form action="{{ route('recensione.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="id_evento" value="{{ $evento->id }}">

            <div class="mb-3">
                <label for="commento" class="form-label">Commento</label>
                <textarea name="commento" id="commento" rows="4" class="form-control"
                    placeholder="Scrivi la tua opinione sull'evento..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="voto" class="form-label">Voto</label>
                <select name="voto" id="voto" class="form-select" required>
                    <option value="">Scegli un voto</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>
            </div>

            <div class="mt-3 mb-5">
                <button type="submit" class="btn btn-primary">Invia Recensione</button>
                <a href="{{ route('home') }}" class="btn btn-secondary ms-2">Annulla</a>
            </div>
            <div class="mt-4"></div>
        </form>
    </div>
@endsection