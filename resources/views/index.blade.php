@extends('layouts.master')

@section('title', 'U.S. CORTENO GOLGI')

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('body')
<div class="row mt-4">
    <div class="col-12">
        <img src="{{ asset('img/sfondo.PNG') }}" class="img-fluid" alt="Header Image">
    </div>
</div>
<div class="row">
    <div class="col-lg-9 col-sm-12">
        <div class="citazione">
            <p>ESEMPIO DI PARTENZA PER SITO WEB UNIONE SPORTIVA CORTENO GOLGI
            </p>
        </div>
    </div>
</div>

@endsection