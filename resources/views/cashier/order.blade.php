@extends('cashier.layouts.app')

@section('contents')
    <h2>Customer Orders</h2>

    <table class="table" style="margin-top: 50px; margin-left: 20%; width: 80%;">
        <thead>
            <tr>
                <th style="padding: 5px;">Order Number</th>
                <th style="padding: 5px;">Order Type</th>
                <th style="padding: 5px;">Payment Method</th>
                <th style="padding: 5px;">Total Amount</th>
                <th style="padding: 5px;">Status</th>
                <th style="padding: 5px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customerOrders as $order)
                <tr>
                    <td style="padding: 10px;">{{ $order->order_number }}</td>
                    <td style="padding: 10px;">{{ $order->order_type }}</td>
                    <td style="padding: 10px;">{{ $order->payment_method }}</td>
                    <td style="padding: 10px;">₱{{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 10px;">{{ $order->status }}</td>
                    <td style="padding: 10px;">
                        <a href="{{ route('customer.view_order', ['orderId' => $order->order_number]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
