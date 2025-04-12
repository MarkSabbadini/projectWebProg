@extends('layouts.master')

@section('title', 'Nuova Squadra')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('squadre') }}">Le nostre squadre</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuova Squadra</li>
@endsection

@section('body')
    <div class="container my-5">
        <h2 class="text-center mb-4">Inserisci Nuova Squadra</h2>

        <form method="POST" action="{{ route('squadra.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nomeSquadraInput" class="form-label">Nome della squadra</label>
                <input type="text" class="form-control" name="nome_squadra" id="nomeSquadraInput" required>
                <div class="invalid-feedback" id="nomeSquadraFeedback">
                    ⚠️ Esiste già una squadra con questo nome.
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Calciatori</h5>
            <div id="calciatori-container">
                <div class="row mb-3 calciatore-row align-items-center" data-index="0">
                    <div class="col-md-3">
                        <input type="text" name="calciatori[0][nome]" class="form-control nome-calciatore"
                            placeholder="Nome" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="calciatori[0][cognome]" class="form-control cognome-calciatore"
                            placeholder="Cognome" required>
                        <div class="invalid-feedback d-none">⚠️ Calciatore già assegnato ad un'altra squadra.</div>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="calciatori[0][numero]" class="form-control" placeholder="Numero"
                            required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="calciatori[0][ruolo]" class="form-control" placeholder="Ruolo" required>
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm rimuovi-calciatore" title="Rimuovi">
                            ❌
                        </button>
                    </div>
                </div>
            </div>


            <button type="button" class="btn btn-secondary mb-4" id="aggiungi-calciatore">+ Aggiungi calciatore</button>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Salva squadra</button>
            </div>
        </form>
    </div>

    {{-- SCRIPT --}}
    <script>
        // Controllo univocità del nome squadra
        $('#nomeSquadraInput').on('change', function () {
            const nomeInput = $(this);
            const feedback = $('#nomeSquadraFeedback');

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

        // Controllo che il calciatore non sia in un'altra squadra
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

        // Aggiungo un nuovo calciatore dinamicamente
        // Aggiunta riga
        let index = 1;
        $('#aggiungi-calciatore').on('click', function () {
            const container = $('#calciatori-container');

            const row = `
                <div class="row mb-3 calciatore-row align-items-center" data-index="${index}">
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
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm rimuovi-calciatore" title="Rimuovi">
                            ❌
                        </button>
                    </div>
                </div>
            `;

            container.append(row);
            index++;
        });

        // Rimuove riga calciatore
        $(document).on('click', '.rimuovi-calciatore', function () {
            $(this).closest('.calciatore-row').remove();
        });
    </script>
@endsection