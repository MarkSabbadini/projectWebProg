@extends('layouts.master')

@section('title', 'Modifica Evento')

@section('body')
    <div class="container mt-5">
        <h2>Modifica Evento</h2>

        <form method="POST" action="{{ route('evento.update', $evento->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $evento->nome) }}" required>
            </div>

            <div class="mb-3">
                <label for="data_evento">Data evento</label>
                <input type="date" name="data" id="data_evento" class="form-control"
                     value="{{ old('data', \Carbon\Carbon::parse($evento->data)->format('Y-m-d')) }}"
                    required>
            </div>


            <div class="mb-3">
                <label>Tipo</label>
                <input type="text" class="form-control" value="{{ $evento->tipo }}" disabled>
            </div>

            <div class="mb-3">
                <label>Descrizione</label>
                <textarea name="descrizione" class="form-control">{{ old('descrizione', $evento->descrizione) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Locandina (opzionale - sovrascrive la precedente)</label>
                <input type="file" name="locandina_path" class="form-control">

                @if($evento->locandina_path)
                    <p class="mt-2">Locandina attuale: <a href="{{ asset('storage/' . $evento->locandina_path) }}"
                            target="_blank">Visualizza</a></p>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Salva modifiche</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Annulla</a>
        </form>
    </div>
@endsection