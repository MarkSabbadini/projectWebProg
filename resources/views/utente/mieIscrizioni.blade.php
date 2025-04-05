@extends('layouts.master')

@section('title', 'Le mie iscrizioni')

@section('body')
    <div class="container mt-5">
        <h2 class="mb-4">Le mie iscrizioni</h2>



        @if($iscrizioni->count())
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Evento</th>
                            <th>Edizione</th>
                            <th>Tipo</th>
                            <th>Descrizione</th>
                            <th>Ricevuta</th>
                            <th>Data iscrizione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($iscrizioni as $evento)
                            <tr>
                                <td>{{ $evento->nome }}</td>
                                <td>{{ $evento->edizione }}</td>
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
                                    @if($evento->pivot->created_at)
                                        {{ $evento->pivot->created_at->format('d/m/Y H:i') }}
                                    @else
                                        ---
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Non hai ancora effettuato iscrizioni a nessun evento.
            </div>
        @endif
    </div>
@endsection