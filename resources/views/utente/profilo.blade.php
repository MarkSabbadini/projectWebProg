@extends('layouts.master')

@section('title', 'Il Mio Profilo')

@section('body')
<div class="container mt-4">
    <h3>Ciao, {{ $utente->nome }}!</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nome:</strong> {{ $utente->nome }}</li>
        <li class="list-group-item"><strong>Cognome:</strong> {{ $utente->cognome }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $utente->email }}</li>
        <li class="list-group-item"><strong>Comune:</strong> {{ $utente->comune }}</li>
    </ul>
</div>
@endsection
