@extends('layouts.master')

@section('title', '26° RADUNO SCIALPINISTICO VALDICORTENO')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">26° RADUNO SCIALPINISTICO VALDICORTENO </li>
@endsection

@section('body')
    <div class="container mt-5">
        <h2>Iscrizione 26° RADUNO SCIALPINISTICO VALDICORTENO</h2>

        <a href="{{ route('iscrizioneRadunoSingolo') }}" class="btn btn-primary">Modulo iscrizione per singolo</a>          
  
    </div>
@endsection

