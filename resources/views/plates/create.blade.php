@extends('layouts.app')

@section('content')
<div class="create-box">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card" style="background-color: #f3d9bf; padding: 20px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                    <div>
                        <h1 class=" fw-bolder" >Create a Plate</h1>
                    </div>
    
                    <div class="card-body bg">
                        <form method="POST" action="{{ route('plates.store') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name*') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <label for="ingredients" class="col-md-4 col-form-label text-md-right">{{ __('Ingredients *') }}</label>
    
                                <div class="col-md-6">
                                    <textarea id="ingredients" rows="5" class="form-control h-100 @error('ingredients') is-invalid @enderror" name="ingredients"  autocomplete="ingredients" autofocus>{{ old('ingredients') }}</textarea>    
                                    @error('ingredients')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price *') }}</label>
    
                                <div class="col-md-6">
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">€</span>
                                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" aria-label="Amount (to the nearest dollar)">
                                    </div>
    
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
    
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" accept=".jpg, .bpm, .png, .svg" autocomplete="image" autofocus>
    
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <label for="visible" class="col-md-4 col-form-label text-md-right">{{ __('Visible ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="visible" type="checkbox" class="form-check-input" value='{{true}}' name="visible">
                                </div>
                            </div>
    
                            <div class="my-3 fw-bold ">
                                * Required field
                            </div>
    
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex gap-5">
                                    <a class="btn btn-primary text-decoration-none" href="{{ route('plates.index') }}"><i class="fa-solid fa-left-long fs-3"></i></a>
                                    <button type="submit" class="btn btn-primary border-0 fs-5" style="background-color: #279647">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection