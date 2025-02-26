@extends('layouts.master')

@section('title', 'Modulo iscrizione singolo Raduno 2025')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Iscrizione raduno scialpinistico valdicorteno 2025</li>
@endsection

@section('body')

<form class="row g-3">
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">Nome</label>
        <input type="text" class="form-control" id="validationDefault01" required>
    </div>
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Cognome</label>
        <input type="text" class="form-control" id="validationDefault02" required>
    </div>
    <div class="col-md-4">
        <label for="exampleFormControlInput1" class="form-label">Indirizzo email</label>
        <div class="input-group">
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">Cellulare</label>
        <input type="tel" class="form-control" id="validationDefault03" required>
    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">Comune di residenza</label>
        <input type="text" class="form-control" id="validationDefault03" required>
    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">Provincia</label>
        <input type="text" class="form-control" id="validationDefault03" required>
    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">Indirizzo</label>
        <input type="text" class="form-control" id="validationDefault03" required>
    </div>
    <div class="col-md-3">
        <label for="validationDefault04" class="form-label">State</label>
        <select class="form-select" id="validationDefault04" required>
            <option selected disabled value="">Seleziona tipologia di iscrizione</option>
            <option>Iscrizione senza pranzo € 25</option>
            <option>Iscrizione con pranzo € 35</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="formFileMultiple" class="form-label">Carica qui la ricevuta del tuo pagamento</label>
        <input class="form-control" type="file" id="formFileMultiple" multiple>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
                Iscrivendomi dichiaro di aver letto ed accettato il regolamento <a
                    href="{{ url('/documents/regolamento.pdf') }}" target="_blank">qui
                    riportato</a>
            </label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
</form>

@endsection


@section('breadcrumb')

@endsection