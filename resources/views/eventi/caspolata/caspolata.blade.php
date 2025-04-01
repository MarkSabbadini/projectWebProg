@extends('layouts.master')

@section('title', 'EVENTO CASPOLATA')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Caspolando nelle valli di S. Antonio</li>
@endsection

@section('body')
    @php use Illuminate\Support\Str; @endphp

    <div class="container mt-5">

    @forelse($caspolata_list as $evento)

        <div class="card mt-4">
            <div class="card-body">
                <div class="row align-items-start">
                    
                    <div class="col-md-8">
                        <h4 class="card-title">{{ $evento->nome }}</h4>
                        <p><strong>Edizione:</strong> {{ $evento->edizione }}</p>
                        <p><strong>Descrizione:</strong> {{ $evento->descrizione }}</p>

                        <a href="{{ route('caspolata.iscrizione', ['evento' => $evento->id]) }}" class="btn btn-primary mt-2">Modulo iscrizione</a>

                    </div>

                    
                    <div class="col-md-4 text-end">
                        @if($evento->locandina_path)
                            @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $evento->locandina_path) }}" alt="Locandina" class="img-thumbnail" style="max-width: 100%; height: auto;">
                            @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="200px" style="border: none;"></iframe>
                            @else
                                <a href="{{ asset('storage/' . $evento->locandina_path) }}" target="_blank">Visualizza locandina</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>Nessuna <b>CASPOLATA</b> disponibile al momento!</p>
        @endforelse
    </div>
@endsection
