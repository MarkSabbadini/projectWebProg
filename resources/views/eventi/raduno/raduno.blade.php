@extends('layouts.master')

@section('title', 'RADUNO SCIALPINISTICO')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Raduno scialpinistico Val di Corteno</li>
@endsection

@section('body')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp

<div class="container mt-5">

    {{-- SE ADMIN --}}
    @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
        <h3>Gestione eventi Raduno</h3>
        @foreach($raduno_list as $evento)
            <div class="row mb-4 p-3 border rounded">
                <div class="col-md-8">
                    <h5>{{ $evento->nome }}</h5>
                    <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                    <p>{{ $evento->descrizione }}</p>

                    <div class="mt-2">
                        <a href="{{ route('evento.edit', ['id' => $evento->id]) }}" class="btn btn-warning">Modifica</a>
                        <form action="{{ route('evento.delete', ['id' => $evento->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Sei sicuro di voler eliminare l\'evento: {{ addslashes($evento->nome) }}?')">
                                Elimina
                            </button>
                        </form>
                        <a href="{{ route('evento.iscritti', ['id' => $evento->id]) }}" class="btn btn-info">Mostra iscritti</a>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    @if($evento->locandina_path)
                        @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                        @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                            <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;"></iframe>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach

    {{-- SE REGISTERED USER --}}
    @elseif(isset($_SESSION['logged']) && $_SESSION['role'] === 'registered_user')
        @php
            $oggi = Carbon::today();
            $eventi_futuri = collect();
            $eventi_partecipati = collect();
            $eventi_passati_non_iscritti = collect();

            foreach ($raduno_list as $evento) {
                $dataEvento = Carbon::parse($evento->data);
                $iscritto = $mie_iscrizioni->contains((int) $evento->id);

                if ($dataEvento->greaterThanOrEqualTo($oggi)) {
                    $eventi_futuri->push(['evento' => $evento, 'iscritto' => $iscritto]);
                } elseif ($dataEvento->lessThan($oggi) && $iscritto) {
                    $eventi_partecipati->push($evento);
                } elseif ($dataEvento->lessThan($oggi) && !$iscritto) {
                    $eventi_passati_non_iscritti->push($evento);
                }
            }
        @endphp

        <div class="row">
            {{-- Eventi futuri --}}
            <div class="col-md-6">
                <h3>Eventi futuri</h3>
                @foreach($eventi_futuri as $entry)
                    @php
                        $evento = $entry['evento'];
                        $iscritto = $entry['iscritto'];
                    @endphp
                    <div class="row mb-4 p-3 border rounded">
                        <div class="col-md-8">
                            <h5>{{ $evento->nome }}</h5>
                            <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                            <p>{{ $evento->descrizione }}</p>
                            @if($iscritto)
                                <button class="btn btn-success" disabled>✅ Sei già iscritto</button>
                            @else
                                <a href="{{ route('raduno.iscrizione', ['evento' => $evento->id]) }}" class="btn btn-primary">Modulo iscrizione</a>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            @if($evento->locandina_path)
                                @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                    <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Partecipati e passati --}}
            <div class="col-md-6">
                <h3>Eventi a cui hai partecipato</h3>
                @foreach($eventi_partecipati as $evento)
                    <div class="row mb-4 p-3 border rounded bg-light">
                        <div class="col-md-8">
                            <h5>{{ $evento->nome }}</h5>
                            <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                            <p>{{ $evento->descrizione }}</p>
                            <button class="btn btn-success" disabled>✅ Partecipato</button>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($evento->locandina_path)
                                @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                    <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach

                <h4 class="mt-5">Eventi passati a cui non hai partecipato</h4>
                @foreach($eventi_passati_non_iscritti as $evento)
                    <div class="row mb-4 p-3 border rounded">
                        <div class="col-md-8">
                            <h5>{{ $evento->nome }}</h5>
                            <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                            <p>{{ $evento->descrizione }}</p>
                            <button class="btn btn-secondary" disabled>Iscrizione chiusa</button>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($evento->locandina_path)
                                @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                    <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    {{-- SE GUEST --}}
    @else

    <div class="alert alert-info text-center" role="alert">
        Accedi o registrati per iscriverti ad un evento!
    </div>

        <h3>Eventi Raduno</h3>
        @foreach($raduno_list as $evento)
            <div class="row mb-4 p-3 border rounded">
                <div class="col-md-8">
                    <h5>{{ $evento->nome }}</h5>
                    <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                    <p>{{ $evento->descrizione }}</p>
                </div>
                <div class="col-md-4 text-end">
                    @if($evento->locandina_path)
                        @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                        @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                            <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;"></iframe>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
