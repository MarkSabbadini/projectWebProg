@extends('layouts.master')

@section('title', 'Modifica Squadra')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('squadre') }}">Le nostre squadre</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifica squadra</li>
@endsection

@section('body')
<div class="container my-5">
    <h2 class="text-center mb-4">Modifica Squadra</h2>

    <form method="POST" action="{{ route('squadra.update', $squadra->id) }}">
        @csrf

       
        <input type="hidden" id="nomeOriginale" value="{{ $squadra->nome }}">

        
        <div class="mb-4">
            <label for="nomeSquadraInput" class="form-label">Nome della squadra</label>
            <input type="text" class="form-control" name="nome_squadra" id="nomeSquadraInput" value="{{ $squadra->nome }}" required>
            <div class="invalid-feedback" id="nomeSquadraFeedback">
                ⚠️ Esiste già una squadra con questo nome.
            </div>
        </div>

        <hr>

        
        <h5 class="mb-3">Calciatori</h5>
        <div id="calciatori-container">
            @foreach($squadra->calciatori as $i => $c)
                <div class="row mb-3 calciatore-row" data-index="{{ $i }}">
                    <div class="col-md-3">
                        <input type="text" name="calciatori[{{ $i }}][nome]" class="form-control nome-calciatore" value="{{ $c->nome }}" placeholder="Nome" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="calciatori[{{ $i }}][cognome]" class="form-control cognome-calciatore" value="{{ $c->cognome }}" placeholder="Cognome" required>
                        <div class="invalid-feedback d-none">⚠️ Calciatore già assegnato ad un'altra squadra.</div>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="calciatori[{{ $i }}][numero]" class="form-control" value="{{ $c->numero }}" placeholder="Numero" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="calciatori[{{ $i }}][ruolo]" class="form-control" value="{{ $c->ruolo }}" placeholder="Ruolo" required>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-4" id="aggiungi-calciatore">+ Aggiungi calciatore</button>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </div>
    </form>
</div>


<script>
    // Controllo AJAX che non esista già una squadra con stesso nome, va bene se lascio stesso nome
    $('#nomeSquadraInput').on('change', function () {
        const nomeInput = $(this);
        const nomeOriginale = $('#nomeOriginale').val();
        const feedback = $('#nomeSquadraFeedback');

        if (nomeInput.val() === nomeOriginale) {
            nomeInput.removeClass('is-invalid');
            feedback.hide();
            return;
        }

        $.ajax({
            url: '/ajax/check-squadra-nome',
            method: 'POST',
            data: {
                nome: nomeInput.val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.found) {
                    nomeInput.addClass('is-invalid');
                    feedback.show();
                    nomeInput.val('');
                } else {
                    nomeInput.removeClass('is-invalid');
                    feedback.hide();
                }
            },
            error: function (xhr) {
                console.error('Errore AJAX:', xhr);
            }
        });
    });

    // Controllo che un calciatore non sia già assegnato ad altra squadra, in caso metto un warning ma non blocco!
    $(document).on('change', '.cognome-calciatore', function () {
        const cognomeInput = $(this);
        const row = cognomeInput.closest('.calciatore-row');
        const nomeInput = row.find('.nome-calciatore');
        const feedback = row.find('.invalid-feedback');
        const nomeSquadra = $('#nomeSquadraInput').val();

        $.ajax({
            url: '/ajax/check-calciatore',
            method: 'POST',
            data: {
                nome: nomeInput.val(),
                cognome: cognomeInput.val(),
                nome_squadra: nomeSquadra,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.found) {
                    cognomeInput.addClass('is-invalid');
                    feedback.removeClass('d-none');
                } else {
                    cognomeInput.removeClass('is-invalid');
                    feedback.addClass('d-none');
                }
            },
            error: function (xhr) {
                console.error('Errore AJAX:', xhr);
            }
        });
    });

    // Aggiungo un nuovo calciatore in maniera dinamica

    let index = {{ count($squadra->calciatori) }};
    $('#aggiungi-calciatore').on('click', function () {
        const container = $('#calciatori-container');

        const row = `
            <div class="row mb-3 calciatore-row" data-index="${index}">
                <div class="col-md-3">
                    <input type="text" name="calciatori[${index}][nome]" class="form-control nome-calciatore" placeholder="Nome" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="calciatori[${index}][cognome]" class="form-control cognome-calciatore" placeholder="Cognome" required>
                    <div class="invalid-feedback d-none">⚠️ Calciatore già assegnato ad un'altra squadra.</div>
                </div>
                <div class="col-md-2">
                    <input type="number" name="calciatori[${index}][numero]" class="form-control" placeholder="Numero" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="calciatori[${index}][ruolo]" class="form-control" placeholder="Ruolo" required>
                </div>
            </div>
        `;

        container.append(row);
        index++;
    });
</script>
@endsection
