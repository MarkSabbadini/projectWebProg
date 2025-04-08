@extends('layouts.master') {{-- Usa il layout che hai condiviso --}}

@section('title', 'Pagina non trovata - U.S. Corteno Golgi')

@section('body')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Errore 404 - Pagina non trovata</h5>
                </div>
                <div class="card-body text-center">
                    <p class="fs-5">{{ $message ?? 'La pagina che stai cercando non esiste o non è accessibile.' }}</p>
                    <a href="{{ route('home') }}" class="btn btn-danger mt-3">
                        <i class="bi bi-house-door-fill me-1"></i> Torna alla home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
