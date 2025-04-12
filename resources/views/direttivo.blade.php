@extends('layouts.master')

@section('title', 'CONSIGLIO DIRETTIVO')

@section('active_home', 'active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">DIRETTIVO 2020-2025</li>
@endsection

@section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h1 class="text-center mb-4">Direttivo 2020 - 2025</h1>

            <ul class="list-group list-group-flush shadow-sm mb-4">
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Presidente - Savardi Emma</strong> <span>...</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Vicepresidente - Savardi Giovanni</strong> <span>...</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Segretario - Bianchi Eleonora</strong> <span>...</span>
                </li>
            </ul>

            <h5 class="mt-4">Consiglieri</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Sabbadini Alex</li>
                <li class="list-group-item">Sabbadini Marco</li>
                <li class="list-group-item">Savardi Matteo</li>
                <li class="list-group-item">Taddei Gabriele</li>
                <li class="list-group-item">Taddei Riccardo</li>

               
            </ul>
        </div>
    </div>
</div>
@endsection
