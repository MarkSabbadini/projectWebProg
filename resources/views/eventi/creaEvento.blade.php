@extends('layouts.master')

@section('title', 'CREA UN EVENTO')
@section('active_home', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">CREAZIONE DI UN NUOVO EVENTO</li>
@endsection

@section('body')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('evento.store') }}" enctype="multipart/form-data">
        @csrf

       
        <div class="row g-2 align-items-center mb-3">
            <div class="col-auto">
                <label for="inputNome" class="col-form-label">Nome evento</label>
            </div>
            <div class="col-auto">
                <input id="inputNome" name="nome" class="form-control" type="text" placeholder="Nome..." required>
            </div>
            <div class="col-auto">
                <label for="yearSelect" class="col-form-label">Data</label>
            </div>
            <div class="col-auto">
                <input type="date" class="form-control" id="dataEvento" name="data" required>
            </div>

        </div>

        <div class="row g-2 mb-3">
            <div class="col-12">
                <label for="inputDescrizione" class="form-label">Inserisci una breve descrizione dell'evento</label>
                <input id="inputDescrizione" name="descrizione" class="form-control" type="text"
                    placeholder="Descrizione..." required>
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Tipologia evento</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="gridRadios1" value="Raduno" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Raduno scialpinistico
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="gridRadios2" value="Caspolata">
                        <label class="form-check-label" for="gridRadios2">
                            Caspolata
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="mb-3">
            <label for="formFile" class="form-label">Carica la locandina dell'evento</label>
            <input class="form-control" type="file" id="locandina_path" name="locandina_path">
        </div>

        <div class="form-group row mt-3">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Inserisci evento</button>
            </div>
        </div>
    </form>

    <script>
        $('#dataEvento').on('change', function () {
            $.ajax({
                url: '/ajax/check-event-date',
                method: 'POST',
                data: {
                    data: $(this).val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.found) {
                        alert('⚠️ Esiste già un evento in questa data!');
                        $('#dataEvento').val('');
                    }
                },
                error: function (xhr) {
                    console.error('Errore AJAX:', xhr);
                }
            });
        });
    </script>



    <!-- Script per popolare dinamicamente la select degli anni -->
    <script>
        const yearSelect = document.getElementById('yearSelect');
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 1;
        const finalYear = currentYear + 10;

        for (let anno = startYear; anno <= finalYear; anno++) {
            const option = document.createElement('option');
            option.value = anno;
            option.textContent = anno;
            yearSelect.appendChild(option);
        }
    </script>
@endsection