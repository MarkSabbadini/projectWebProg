@extends('layouts.master')

@section('title', 'Il Mio Profilo')

@section('body')
    <div class="container mt-5">
        <h2 class="mb-4">Area Personale</h2>

        {{-- MESSAGGI FLASH --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        @endif

        @if($utente)
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Dati Utente</h4>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Nome:</strong> {{ $utente->nome ?? '---' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Cognome:</strong> {{ $utente->cognome ?? '---' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Email:</strong> {{ $utente->email ?? '---' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Cellulare:</strong> {{ $utente->cellulare ?? '---' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Via:</strong> {{ $utente->via ?? '---' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Comune:</strong> {{ $utente->comune ?? '---' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Provincia:</strong> {{ $utente->provincia ?? '---' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Nazione:</strong> {{ $utente->nazione ?? '---' }}
                        </div>
                    </div>

                    {{-- PULSANTE MODIFICA --}}
                    <div class="text-end mt-3">
                        <a href="{{ route('profilo.edit') }}" class="btn btn-primary">Completa o modifica profilo</a>
                    </div>

                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <p>Profilo non ancora creato. <a href="{{ route('profilo.create') }}">Clicca qui per crearlo</a>.</p>
            </div>
        @endif
    </div>
@endsection
