@extends('layouts.master')

@section('title', 'Iscritti a ' . $evento->nome)

@section('body')
    <div class="container mt-5">
        <h2>Iscritti alla {{ $evento->nome }} del {{ $evento->data }}</h2>

        @if($evento->iscritti->count())
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Email</th>
                        <th>Comune</th>
                        <th>Ricevuta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evento->iscritti as $utente)
                        <tr>
                            <td>{{ $utente->nome }}</td>
                            <td>{{ $utente->cognome }}</td>
                            <td>{{ $utente->email }}</td>
                            <td>{{ $utente->comune }}</td>
                            <td>
                                @if($utente->pivot->ricevuta)
                                    <a href="{{ asset('storage/' . $utente->pivot->ricevuta) }}" target="_blank">Visualizza</a>
                                @else
                                    Nessuna ricevuta
                                @endif
                            </td>
                        </tr>

                    @endforeach
                    @if($evento->iscritti->count())
                            <div class="mb-3">
                                <a href="{{ route('eventi.exportCSV', $evento->id) }}" class="btn btn-success">
                                    Scarica elenco .CSV 
                                </a>
                            </div>
                        @endif
                </tbody>
            </table>
        @else
            <p class="mt-4">Nessun iscritto al momento.</p>
        @endif
    </div>
@endsection