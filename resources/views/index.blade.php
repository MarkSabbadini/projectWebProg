@extends('layouts.master')

@section('title', 'U.S. CORTENO GOLGI')

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('body')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10 text-center">
            <h1 class="mb-4">Chi Siamo</h1>
            <div class="card shadow-sm border-0 p-4">
                <p class="lead mb-0">
                    L’<strong>Unione Sportiva Corteno Golgi A.S.D.</strong> è un'associazione dilettantistica senza scopo di lucro,
                    presente sul territorio da più di 50 anni con lo scopo principale di <strong>promuovere le attività sportive</strong> 
                    tra la popolazione, principalmente tra bambini e ragazzi.
                </p>
                <p class="mt-3 mb-0">
                    L’associazione favorisce l’esperienza dello sport come mezzo di crescita personale e sociale, 
                    incentivando anche la conoscenza e la valorizzazione del territorio.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
