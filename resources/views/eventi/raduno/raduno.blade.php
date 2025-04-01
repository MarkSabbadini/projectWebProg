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

                    <a href="{{ route('evento.edit', ['id' => $evento->id]) }}" class="btn btn-warning mt-2 ms-2">Modifica evento</a>


                    <form action="{{ route('evento.delete', ['id' => $evento->id]) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Sei sicuro di voler eliminare l\'evento: {{ addslashes($evento->nome) }}?')">
                                Elimina Raduno Scialpinistico
                            </button>
                        </form>

                    
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
            <p>Nessun <b>RADUNO SCIALPINISTICO</b> disponibile al momento!</p>
        @endforelse
    </div>
@endsection
