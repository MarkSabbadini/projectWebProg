@extends('layouts.master')

@section('title', 'Crea Profilo')

@section('body')
<div class="container mt-5">
    <h2 class="mb-4">Completa il tuo profilo</h2>
    <form method="POST" action="{{ route('profilo.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Cognome</label>
            <input type="text" name="cognome" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Cellulare</label>
            <input type="text" name="cellulare" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Via</label>
            <input type="text" name="via" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Comune</label>
            <input type="text" name="comune" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Provincia</label>
            <input type="text" name="provincia" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Nazione</label>
            <input type="text" name="nazione" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Crea Profilo</button>
    </form>
</div>
@endsection
