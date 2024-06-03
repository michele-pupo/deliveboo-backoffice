@extends('layouts.app')

@section('content')
<div class="index-box">
    
    <div class="container">
       
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card p-3 pb-5">
                    <div class="my-4 d-flex flex-column flex-lg-row justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <a class="btn btn-primary text-decoration-none fs-3" href="{{ route('restaurant') }}"><i class="fa-solid fa-left-long"></i></a>
                        </div>

                        <div class=" fw-bolder text-center">
                            <h1 class="fw-bold">Your Plates</h1>
                        </div>

                        <div>
                            <a class="btn btn-success text-decoration-none fs-3" href="{{ route('plates.create') }}"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                        @foreach ($plates as $plate)
                        <div class="col">
                            <a href="{{ route('plates.show', $plate->id) }}" class="text-decoration-none">
                                <div class="card m-2 border-1 rounded-5 shadow-lg h-100">
                                    <img src="{{ asset('storage/' . $plate->image) }}" class="card-img-top object-fit-cover" alt="{{ $plate->name }}" style="height: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $plate->name }}</h5>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="card-text">{{ $plate->price }} &euro;</h6>
                                            @if($plate->visible)
                                            <p>Visible</p>
                                            
                                            @else
                                            <p>Not Visible</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
