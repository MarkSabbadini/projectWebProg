@extends('layouts.master')

@section('title', 'LA NOSTRA STORIA')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">LA NOSTRA STORIA</li>
@endsection

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <div class="citazione">
                <p>L'U.S. Corteno Golgi nasce nel ....</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-sm-12 text-center">
            <img class="img-thumbnail img-responsive" src="{{ url('/') }}/img/1.jpg" alt="Immagine 1">
        </div>
        <div class="col-lg-6 col-sm-12 text-center">
            <img class="img-thumbnail img-responsive" src="{{ url('/') }}/img/loc.jpg" alt="Immagine 2">
        </div>
    </div>
</div>
@endsection