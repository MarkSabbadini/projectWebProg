@extends('layouts.master')

@section('title', 'Le mie iscrizioni')

@section('body')
<div class="container mt-5">

    {{-- MESSAGGI --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ISCRIZIONI FUTURE --}}
    <h4>Iscrizioni attive</h4>

    @php
        $future = $iscrizioni->filter(function ($evento) {
            return $evento->data && \Carbon\Carbon::parse($evento->data)->isFuture();
        });
    @endphp

    @if($future->count())
        <div class="table-responsive mb-5">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Descrizione</th>
                        <th>Ricevuta</th>
                        <th>Data iscrizione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($future as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->data)->format('d-m-Y') }}</td>
                            <td>{{ $evento->tipo }}</td>
                            <td>{{ $evento->descrizione }}</td>
                            <td>
                                @if($evento->pivot->ricevuta)
                                    <a href="{{ asset('storage/' . $evento->pivot->ricevuta) }}" target="_blank">Visualizza</a>
                                @else
                                    ---
                                @endif
                            </td>
                            <td>
                                {{ optional($evento->pivot->created_at)->format('d/m/Y H:i') ?? '---' }}
                            </td>
                            <td>
                                <form action="{{ route('iscrizione.delete', ['evento_id' => $evento->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler annullare l\'iscrizione?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Annulla</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Nessuna iscrizione attiva al momento.</div>
    @endif

    {{-- EVENTI PASSATI --}}
    <h4>Eventi a cui hai partecipato</h4>

    @php
        $past = $iscrizioni->filter(function ($evento) {
            return $evento->data && \Carbon\Carbon::parse($evento->data)->isPast();
        });
    @endphp

    @if($past->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Descrizione</th>
                        <th>Ricevuta</th>
                        <th>Data iscrizione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($past as $evento)
                        <tr>
                            <td>{{ $evento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($evento->data)->format('d-m-Y') }}</td>
                            <td>{{ $evento->tipo }}</td>
                            <td>{{ $evento->descrizione }}</td>
                            <td>
                                @if($evento->pivot->ricevuta)
                                    <a href="{{ asset('storage/' . $evento->pivot->ricevuta) }}" target="_blank">Visualizza</a>
                                @else
                                    ---
                                @endif
                            </td>
                            <td>
                                {{ optional($evento->pivot->created_at)->format('d/m/Y H:i') ?? '---' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Non hai partecipato ad alcun evento passato.</div>
    @endif

</div>
@endsection
