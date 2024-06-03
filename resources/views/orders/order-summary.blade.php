@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div style="height: 820px;  background-color: rgba(255, 255, 255, 0.427); padding: 20px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;" class="rounded-3">
                <h1 class="text-center pb-3">Order Summary</h1>
                <div style= "overflow-y: auto; max-height: 700px" class="my-scrollbar">
                    <table class="table mt-4" style="--bs-table-bg: trasparent">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Order ID</th> --}}
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="d-none d-md-block">Created At</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders->sortByDesc('created_at') as $order)
                                <tr>
                                    {{-- <td>{{ $order->id }}</td> --}}
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->surname }}</td>
                                    <td>{{ $order->total }} €</td>
                                    <td class="text-danger fw-bold d-none d-md-block">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY, HH:mm') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success" style="font-size: 11px">Show order</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div style="background-color: rgba(255, 255, 255, 0.427); padding: 20px; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;" class="border-3 rounded-3">
                <h1 class="text-center">Stats</h1>
                {!! $chartjs->render() !!}
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('restaurant') }}" class="btn btn-primary fs-5">Back to Restaurant</a>
            </div>
        </div>
    </div>
</div>
@endsection