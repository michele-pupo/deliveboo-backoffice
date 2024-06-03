@extends('layouts.app')
@section('content')

<div class="profile-box">
    <div class="container pb-5 ">
    
        <h2 class="fs-3 my-3 text-black fw-bolder">
            {{ __('Profile') }}
        </h2>
        <div class="card p-4 mb-4 shadow rounded-lg text-black">
    
            @include('profile.partials.update-profile-information-form')
    
        </div>
    
        <div class="card p-4 mb-4 shadow rounded-lg">
    
    
            @include('profile.partials.update-password-form')
    
        </div>
    
        <div class="card p-4 mb-4 shadow rounded-lg">
    
    
            @include('profile.partials.delete-user-form')
    
        </div>
    </div>
</div>


@endsection
