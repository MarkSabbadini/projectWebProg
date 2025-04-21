@extends('layouts.master')

@section('title', 'Le nostre squadre')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Le nostre squadre</li>
@endsection

@section('body')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
                <a href="{{ route('squadra.create') }}" class="btn btn-success shadow">+ Aggiungi nuova squadra</a>
            @endif
        </div>

        <div class="row">
            @forelse ($squadre as $squadra)
                <div class="col-md-6 col-lg-4 d-flex">
                    <div class="card mb-4 shadow-lg rounded-3 w-100 border-0">

                        {{-- IMAGINE??--}}
                        {{--
                        @if ($squadra->foto)
                        <img src="{{ asset('storage/' . $squadra->foto) }}" class="card-img-top rounded-top"
                            alt="{{ $squadra->nome }}">
                        @else
                        <img src="{{ url('/img/Calcio/Open7.jpg') }}" class="card-img-top rounded-top"
                            alt="{{ $squadra->nome }}">
                        @endif
                        --}}

                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-primary fw-bold mb-3">{{ $squadra->nome }}</h3>

                            <p class="card-text mb-2"><strong>Rosa attuale:</strong></p>
                            <ul class="list-unstyled ps-2 mb-4">
                                @forelse ($squadra->calciatori as $calciatore)
                                    <li class="mb-2 d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $calciatore->numero }}</strong>
                                            <span class="nomeCifra">{{ $calciatore->nome }} {{ $calciatore->cognome }}</span>
                                        </div>
                                        <span class="badge bg-secondary text-capitalize">{{ $calciatore->ruolo }}</span>
                                    </li>
                                @empty
                                    <li><em>Nessun calciatore registrato</em></li>
                                @endforelse
                            </ul>


                            @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
                                <div class="d-flex justify-content-between mt-auto">
                                    <a href="{{ route('squadra.edit', $squadra->id) }}"
                                        class="btn btn-warning btn-sm w-50 me-2 shadow-sm">Modifica</a>

                                    <form method="POST" action="{{ route('squadra.destroy', $squadra->id) }}" class="w-50">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 shadow-sm"
                                            onclick="return confirm('Confermi eliminazione?')">
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Nessuna squadra disponibile al momento.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection