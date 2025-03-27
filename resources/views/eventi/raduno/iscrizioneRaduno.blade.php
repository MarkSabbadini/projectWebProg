@extends('layouts.master')

@section('title', 'Modulo iscrizione')

@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Iscrizione raduno scialpinistico valdicorteno 2025</li>
@endsection

@section('body')

    <form class="row g-3" method="POST" action="{{ route('iscrizione.submit') }}" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="evento_id" value="{{ $evento->id }}">

        <div class="col-md-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="col-md-4">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" class="form-control" id="cognome" name="cognome" required>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Indirizzo email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        </div>
        <div class="col-md-6">
            <label for="cellulare" class="form-label">Cellulare</label>
            <input type="tel" class="form-control" id="cellulare" name="cellulare" required>
        </div>
        <div class="col-md-6">
            <label for="via" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" id="via" name="via" required>
        </div>
        <div class="col-md-6">
            <label for="comune" class="form-label">Comune di residenza</label>
            <input type="text" class="form-control" id="comune" name="comune" required>
        </div>
        <div class="col-md-6">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" class="form-control" id="provincia" name="provincia" required>
        </div>
        <div class="col-md-6">
            <label for="provincia" class="form-label">Nazione</label>
            <input type="text" class="form-control" id="nazione" name="provincia" required>
        </div>
        <div class="col-md-6">
            <label for="ricevuta" class="form-label">Carica qui la ricevuta del tuo pagamento</label>
            <input class="form-control" type="file" id="ricevuta" name="ricevuta" required>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="accettazione" name="accettazione" required>
                <label class="form-check-label" for="accettazione">
                    Iscrivendomi dichiaro di aver letto ed accettato il regolamento <a
                        href="{{ url('/documents/regolamento.pdf') }}" target="_blank">qui riportato</a>
                </label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Invia iscrizione</button>
        </div>
    </form>

@endsection