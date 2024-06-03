@extends('layouts.app')

@section('content')
<div class="show-box">
    
    <div class="container d-flex flex-column align-items-center">
      
        <div class="row justify-content-center">
            <div class="col 6 rounded 4" style="background-color: #f3d9bf; padding: 20px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                <div class="d-flex flex-column justify-content-center gap-3">
                  <div>
                    <img src="{{ asset('storage/' . $plate->image) }}" class="img-fluid w-100" alt="@" style="max-height: 400px">
                  </div>
                  <div>
                      <h2 class="text-center py-3 fs-1" style= "font-family: 'Mibery', sans-serif;">{{ $plate->name }}</h2>
                      <p> <span class="fw-bold text-uppercase fs-5">Ingredients:</span> {{ $plate->ingredients }}</p>
                      <p> <span class="fw-bold text-uppercase fs-5">Price:</span> {{ $plate->price }}€</p>
                      @if ($plate->visible == true)
                          <p class="fw-bold fst-italic">This plate is visible</p>
                      @else
                          <p>This plate is not visible</p>
                      @endif
                  </div>
                </div>
                <div class="my-4 d-flex justify-content-between align-items-center">
                    <div>
                      <a class="btn btn-primary text-decoration-none " href="{{ route('plates.index') }}"><i class="fa-solid fa-left-long fs-3"></i></a>
                    </div>
                    <div>
                      <a class="btn text-decoration-none text-white" style="background-color: #279647" href="{{ route('plates.edit', $plate->id) }}"><i class="fa-solid fa-pen-to-square fs-3"></i></a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-trash-can fs-3"></i>
                      </button>
                    </div>
                  </div>
            </div>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete '{{ $plate->name }}' ?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('plates.destroy', $plate) }}" method="POST">
    
                            @csrf
    
                            @method('DELETE')
    
                            <button class="btn btn-danger">Confirm Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
