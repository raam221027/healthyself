@extends('kitchen.layouts.app')

@section('contents')
@include('sweetalert::alert')
<style>
  .clicked {
    background-color: #81B233; 
    opacity: 60%; 
  }

</style>

<div class="container mt-5">
<i><span style="color: #a4f05c; font-weight: 800; font-size:50px;">Kitchen Order List</i>

    @if ($processedOrders->count() > 0)
    <div class="row" >
        
@php
    $cardNumber = 1; // Initialize the card number
@endphp
    @foreach ($processedOrders as $order)
    
    <div class="card" style="background-color: #a4f05c; max-width: 20rem; margin-left: 45px; margin-top:3%;">
    <div class="card-group">
        <div class="card-body d-flex flex-column align-items-center">
            <h5 class="card-title">{{ $cardNumber }}. Order #: {{ $order->order_number }}</h5>
            <p class="card-text">Order Type: {{ $order->order_type }}.</p>
        </div>
    </div>
    <button type="button" class="btn btn-success" data-bs-toggle="modal"
            style="position: absolute; bottom:0; left:0; height: 100px; width: 100%; opacity:25%;"
            data-bs-target="#exampleModal{{ $order->id }}" ></button>
</div>

@php
    $cardNumber++; // Increment the card number for the next card
@endphp
@endforeach

    </div>
    @else
    <h1>No orders to process in the kitchen.</h1>
    @endif
</div>

@foreach ($processedOrders as $order)
<div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>Order #</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $item->product->title }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <p class="fw-bold fs-4 mt-5">Customized</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($addons[$order->id]) && $addons[$order->id]->count() > 0)
                                @foreach ($addons[$order->id] as $addon)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $addon->customizedProduct->name }}</td>
                                    <td>
                                        <p class="text-success">Toppings</p>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="3">No addons for this order</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                               <a href ="{{ route('done.order', $order->id) }}"
                                type="button"
                                class="btn btn-success btn-lg"
                                style="background-color:#a4f05c; padding-top: 3%; padding-bottom:3%; width: 30%; height:50%; margin-left:35%;">
                                Done
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection
