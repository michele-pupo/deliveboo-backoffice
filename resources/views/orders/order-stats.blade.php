@extends('layouts.app')

@section('content')

<div style="width: 50%; background-color: white;">
    {!! $chartjs->render() !!}
</div>
<div class="text-center mt-5 mx-5">
    <a href="{{ route('restaurant') }}" class="btn btn-secondary">Back to Restaurant</a>
</div>


@endsection