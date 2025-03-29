@extends('layouts.master')

@section('title', 'EVENTO RADUNO')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Raduno scialpinistico Valdicorteno</li>
@endsection

@section('body')
    @php use Illuminate\Support\Str; @endphp

    <div class="container mt-5">

    @forelse($raduno_list as $evento)

        <div class="card mt-4">
            <div class="card-body">
                <div class="row align-items-start">
                    
                    <div class="col-md-8">
                        <h4 class="card-title">{{ $evento->nome }}</h4>
                        <p><strong>Edizione:</strong> {{ $evento->edizione }}</p>
                        <p><strong>Descrizione:</strong> {{ $evento->descrizione }}</p>

                        <a href="{{ route('raduno.iscrizione', ['evento' => $evento->id]) }}" class="btn btn-primary mt-2">Modulo iscrizione</a>

                    </div>

                    
                    <div class="col-md-4 text-end">
                        @if($evento->locandina)
                            @if(Str::endsWith($evento->locandina, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $evento->locandina) }}" alt="Locandina" class="img-thumbnail" style="max-width: 100%; height: auto;">
                            @elseif(Str::endsWith($evento->locandina, ['.pdf']))
                                <iframe src="{{ asset('storage/' . $evento->locandina) }}" width="100%" height="200px" style="border: none;"></iframe>
                            @else
                                <a href="{{ asset('storage/' . $evento->locandina) }}" target="_blank">Visualizza locandina</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>Nessun <b>RADUNO SCIALPINISTICO</b> disponibile al momento!</p>
        @endforelse
    </div>
@endsection
