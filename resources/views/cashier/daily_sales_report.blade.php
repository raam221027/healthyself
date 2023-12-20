@extends('cashier.layouts.app')

@section('contents')
   
    <div class="table-responsive" style="height: 500px; overflow-y: auto; margin-left: 21%; width: 75%; margin-top:10%;">
    <i><span style="color: #a4f05c; font-weight: 800; font-size:38px;">Sales Report</i>
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th style="padding: 5px;">Date & Time</th>
                    <th style="padding: 5px;">Order Number</th>
                    <th style="padding: 5px;">Payment Method</th>
                    <th style="padding: 5px;">Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach($customerOrders as $order)
                    <tr>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <thead class="table table-bordered table-success">
                <tr>
                    <th class="text-center" style="padding: 5px;">Cash</th>
                    <th class="text-center" style="padding: 5px;" colspan="2">GCash</th>
                    <th class="fw-bold">Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="text-center">₱{{ number_format($totalCash, 2) }}</td>
                    <td class="text-center" colspan="2">₱{{ number_format($totalGCash, 2) }}</td>
                    <td colspan="">₱{{ number_format($totalSales, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
