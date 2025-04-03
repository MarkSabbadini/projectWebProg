@extends('layouts.master')

@section('title', 'Modifica Profilo')

@section('body')
<div class="container mt-5">
    <h2 class="mb-4">Completa il tuo profilo</h2>
    <form method="POST" action="{{ route('profilo.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Cognome</label>
            <input type="text" name="cognome" class="form-control" value="{{ old('cognome', $utente->cognome) }}">
        </div>

        <div class="form-group mb-3">
            <label>Cellulare</label>
            <input type="text" name="cellulare" class="form-control" value="{{ old('cellulare', $utente->cellulare) }}">
        </div>

        <div class="form-group mb-3">
            <label>Via</label>
            <input type="text" name="via" class="form-control" value="{{ old('via', $utente->via) }}">
        </div>

        <div class="form-group mb-3">
            <label>Comune</label>
            <input type="text" name="comune" class="form-control" value="{{ old('comune', $utente->comune) }}">
        </div>

        <div class="form-group mb-3">
            <label>Provincia</label>
            <input type="text" name="provincia" class="form-control" value="{{ old('provincia', $utente->provincia) }}">
        </div>

        <div class="form-group mb-3">
            <label>Nazione</label>
            <input type="text" name="nazione" class="form-control" value="{{ old('nazione', $utente->nazione) }}">
        </div>

        <button type="submit" class="btn btn-success">Salva Profilo</button>
    </form>
</div>
@endsection
