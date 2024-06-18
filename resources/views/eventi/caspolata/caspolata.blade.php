@extends('layouts.master')

@section('title', 'CASPOLATA 2025')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">CASPOLATA 2025</li>
@endsection

@section('body')
    <div class="container mt-5">
        <h2>"CASPOLANDO NELLE VALLI DI SANT'ANTONIO" 2025</h2>
        <p>
            Partecipa alla nostra straordinaria Caspolata 2025! Per iscriverti, clicca sul link qui sotto:
        </p>
        <a href="{{ route('iscrizioneCaspolata') }}" class="btn btn-primary">Modulo iscrizione</a>       
    </div>
@endsection

