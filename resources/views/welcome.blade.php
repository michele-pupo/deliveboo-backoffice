@extends('layouts.app')
@section('content')
<div class="jumbotron p-5">
    <div class="container d-flex justify-content-between flex-wrap py-5 px-0">
        <div class="welcome_text d-flex align-items-center ps-3">
            <h1 class="display-5 fw-bold">
                Welcome to<br> DeliveBoo!
            </h1>
        </div>
        <div class="logo_laravel">
            <img class="slide" src="{{ asset('storage/branding/meat.png') }}" alt="@">
        </div>
    </div>
</div>
@endsection