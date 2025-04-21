@extends('layouts.master')

@section('title', 'CASPOLATA NELLE VALLI DI S. ANTONIO')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Caspolando nelle valli di S. Antonio</li>
@endsection

@section('body')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Str;
    @endphp

    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        @endif

        @if(isset($_SESSION['logged']) && $_SESSION['role'] === 'admin')
            <h3 class="mb-4">Gestione eventi Caspolata</h3>
            @foreach($caspolata_list as $evento)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="row g-0">
                        <div class="col-md-8 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="text-primary fw-bold mb-2">{{ $evento->nome }}</h4>
                                <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                                <p class="text-muted">{{ $evento->descrizione }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('evento.edit', $evento->id) }}" class="btn btn-warning btn-sm me-2 shadow-sm">Modifica</a>
                                <form action="{{ route('evento.delete', $evento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm"
                                        onclick="return confirm('Sei sicuro di voler eliminare l\'evento: {{ addslashes($evento->nome) }}?')">
                                        Elimina
                                    </button>
                                </form>
                                <a href="{{ route('evento.iscritti', $evento->id) }}" class="btn btn-info btn-sm ms-2 shadow-sm">Mostra iscritti</a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            @if($evento->locandina_path)
                                @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                    <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;" class="rounded shadow-sm"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        @elseif(isset($_SESSION['logged']) && $_SESSION['role'] === 'registered_user')
            @php
                $oggi = Carbon::today();
                $eventi_futuri = collect();
                $eventi_partecipati = collect();
                $eventi_passati_non_iscritti = collect();

                foreach ($caspolata_list as $evento) {
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
                <div class="col-md-6">
                    <h3 class="mb-4">Eventi futuri</h3>
                    @foreach($eventi_futuri as $entry)
                        @php $evento = $entry['evento']; $iscritto = $entry['iscritto']; @endphp
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="row g-0">
                                <div class="col-md-8 p-4">
                                    <h4 class="fw-bold text-primary mb-2">{{ $evento->nome }}</h4>
                                    <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                                    <p class="text-muted">{{ $evento->descrizione }}</p>
                                    @if($iscritto)
                                        <button class="btn btn-success btn-sm" disabled>✅ Sei già iscritto</button>
                                    @else
                                        <a href="{{ route('caspolata.iscrizione', $evento->id) }}" class="btn btn-primary btn-sm">Modulo iscrizione</a>
                                    @endif
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                                    @if($evento->locandina_path)
                                        @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                        @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                            <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;" class="rounded shadow-sm"></iframe>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3 class="mb-4">Eventi a cui hai partecipato</h3>
                    @foreach($eventi_partecipati as $evento)
                        <div class="card shadow-sm border-0 mb-4 bg-light">
                            <div class="row g-0">
                                <div class="col-md-8 p-4">
                                    <h4 class="fw-bold text-dark mb-2">{{ $evento->nome }}</h4>
                                    <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                                    <p class="text-muted">{{ $evento->descrizione }}</p>
                                    <button class="btn btn-success btn-sm" disabled>✅ Partecipato</button>
                                    @if(isset($utenteId) && !$evento->recensioni->contains('id_utente', $utenteId))
                                        <a href="{{ route('recensione.create', $evento->id) }}" class="btn btn-outline-primary btn-sm mt-2">Aggiungi una recensione</a>
                                    @elseif(isset($utenteId))
                                        <p class="text-muted mt-2">Hai già recensito questo evento.</p>
                                    @endif
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                                    @if($evento->locandina_path)
                                        @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                        @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                            <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;" class="rounded shadow-sm"></iframe>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <h4 class="mt-5 mb-3">Eventi passati a cui non hai partecipato</h4>
                    @foreach($eventi_passati_non_iscritti as $evento)
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="row g-0">
                                <div class="col-md-8 p-4">
                                    <h4 class="fw-bold text-muted mb-2">{{ $evento->nome }}</h4>
                                    <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                                    <p class="text-muted">{{ $evento->descrizione }}</p>
                                    <button class="btn btn-secondary btn-sm" disabled>Iscrizione chiusa</button>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                                    @if($evento->locandina_path)
                                        @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                            <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                        @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                            <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;" class="rounded shadow-sm"></iframe>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        @else
            <div class="alert alert-info text-center" role="alert">
                Accedi o registrati per iscriverti ad un evento!
            </div>
            <h3 class="mb-4">Eventi Caspolata</h3>
            @foreach($caspolata_list as $evento)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="row g-0">
                        <div class="col-md-8 p-4">
                            <h4 class="fw-bold text-primary">{{ $evento->nome }}</h4>
                            <p><strong>Data:</strong> {{ Carbon::parse($evento->data)->format('d-m-Y') }}</p>
                            <p class="text-muted">{{ $evento->descrizione }}</p>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                            @if($evento->locandina_path)
                                @if(Str::endsWith($evento->locandina_path, ['.jpg', '.jpeg', '.png']))
                                    <img src="{{ asset('storage/' . $evento->locandina_path) }}" class="img-fluid rounded shadow-sm">
                                @elseif(Str::endsWith($evento->locandina_path, ['.pdf']))
                                    <iframe src="{{ asset('storage/' . $evento->locandina_path) }}" width="100%" height="250px" style="border: none;" class="rounded shadow-sm"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
