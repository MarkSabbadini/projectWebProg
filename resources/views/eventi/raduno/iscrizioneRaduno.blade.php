@extends('layouts.master')

@section('title', 'Modulo iscrizione Raduno 2025')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Iscrizione Raduno 2025</li>
@endsection

@section('body')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="row g-3" method="POST" action="{{ route('iscrizione.submit') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="evento_id" value="{{ $evento->id }}">

    <div class="col-md-4">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $utente?->nome) }}" required>
    </div>

    <div class="col-md-4">
        <label for="cognome" class="form-label">Cognome</label>
        <input type="text" name="cognome" class="form-control" value="{{ old('cognome', $utente?->cognome) }}" required>
    </div>

    <div class="col-md-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $utente?->email) }}" required>
    </div>

    <div class="col-md-6">
        <label for="cellulare" class="form-label">Cellulare</label>
        <input type="tel" name="cellulare" class="form-control" value="{{ old('cellulare', $utente?->cellulare) }}" required>
    </div>

    <div class="col-md-6">
        <label for="comune" class="form-label">Comune</label>
        <input type="text" name="comune" class="form-control" value="{{ old('comune', $utente?->comune) }}" required>
    </div>

    <div class="col-md-6">
        <label for="via" class="form-label">Indirizzo</label>
        <input type="text" name="via" class="form-control" value="{{ old('via', $utente?->via) }}" required>
    </div>

    <div class="col-md-6">
        <label for="provincia" class="form-label">Provincia</label>
        <input type="text" name="provincia" class="form-control" value="{{ old('provincia', $utente?->provincia) }}" required>
    </div>

    <div class="col-md-6">
        <label for="nazione" class="form-label">Nazione</label>
        <input type="text" name="nazione" class="form-control" value="{{ old('nazione', $utente?->nazione ?? 'Italia') }}" required>
    </div>

    <div class="col-md-6">
        <label for="ricevuta" class="form-label">Carica ricevuta pagamento (PDF, JPG, PNG)</label>
        <input type="file" name="ricevuta" class="form-control" required>
    </div>

    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
                Iscrivendomi dichiaro di aver letto ed accettato il regolamento <a href="{{ url('/documents/regolamento.pdf') }}" target="_blank">qui
                    riportato</a>
            </label>
        </div>
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-primary" type="submit">Iscriviti!</button>
    </div>
</form>

@endsection
