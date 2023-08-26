@extends('order.layouts.app')

@section('content')
    <div class="container">
        <h1>Order History</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>₱{{ $order->totalAmount() }}</td>
                        <td>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
