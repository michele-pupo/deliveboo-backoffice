@extends('layouts.app')

@section('content')
<div class="dashboard">
    <div class="container text-center cardB">
        <h2 class="name fs-3 my-4 fw-bolder">
            Welcome Back {{$user->name}}
        </h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="cards rounded-2">
                    <div class="card-header fw-bolder">
                        <h1 class="fw-bold">{{$restaurant->name_res}}</h1>
                    </div>
                    
                    <div class="card-body d-flex gap-3 flex-column flex-md-row">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        
                        <div style="max-width: 100%; max-height: 500px;">
                            <img class="rounded-5 p-3 img-fluid" src="{{ asset('storage/' . $restaurant->img_res) }}" alt="{{ $restaurant->name }}" style="width: 100%;">
                        </div>
                        
                        <div class="d-flex flex-column gap-3 pt-4 align-items-center">
                            <h3 class="adress text-start text-black">
                                <i class="fa-solid fa-location-dot p-1"></i> {{$restaurant->address_res}}
                            </h3>
                            <div class="d-flex gap-2 align-items-center fw-bolder p-2 overflow-x-auto flex-wrap">
                                <div class=" vanish">Categories:</div>
                                @foreach($restaurant->categories as $category)
                                <span class="categories badge rounded-pill rounded rounded-3 text-black">{{ $category->name }}</span>
                                @endforeach
                            </div>
    
                            <div class="d-flex justify-content-center gap-4 pt-4 me-lg-3">
                                <a href="{{route('plates.index')}}" class="btn text-decoration-none text-white" style="background-color: #e67e22">Menu</a>
                                <a href="{{ route('order-summary') }}" class="btn text-white" style="background-color: #279647">Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
