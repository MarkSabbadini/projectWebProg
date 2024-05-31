@extends('layouts.master')

@section('title', 'U.S. Corteno Golgi')

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('body')
<div class="row">
    <div class="col-lg-9 col-sm-12">
        <div class="citazione">
            <p>ESEMPIO DI PARTENZA PER SITO WEB UNIONE SPORTIVA CORTENO GOLGI
            </p>
        </div>
    </div>

    <div class="col-lg-3 col-sm-12">
        <div class="logo">
            <img class="img-thumbnail img-responsive" src="{{ url('/') }}/img/logo.png">
        </div>
    </div>
</div>
@endsection