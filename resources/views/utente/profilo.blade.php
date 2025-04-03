@extends('layouts.master')

@section('title', 'Il Mio Profilo')

@section('body')
    <div class="container mt-5">
        <h2 class="mb-4">Area Personale</h2>

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

                    @if(empty($utente->cognome) || empty($utente->cellulare))
                        <div class="text-end mt-3">
                            @if($utente)
                                <a href="{{ route('profilo.edit') }}" class="btn btn-warning">Completa il tuo profilo</a>
                            @else
                                <a href="{{ route('profilo.create') }}" class="btn btn-warning">Crea il tuo profilo</a>
                            @endif
                        </div>
                    @endif


                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <p>Profilo non ancora creato. <a href="{{ route('profilo.edit') }}">Clicca qui per crearlo</a>.</p>
            </div>
        @endif
    </div>
@endsection