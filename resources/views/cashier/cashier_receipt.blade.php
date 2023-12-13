@extends('customer.layouts.app-cashier-receipt')
@section('contents')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card  col-md-8 mb-3" id="invoice-POS">
        <div class="card-body">
            <h2 class="text-center">ORDER RECEIPT</h2>
            <div class="order-type">
                <p>Order Type: {{ $order->order_type }}</p>
                <p>Payment Method: {{ $order->payment_method }}</p>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Order #</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orderItems->isEmpty())
                            <tr>
                                <td class="text-center" colspan="5">Order not found</td>
                            </tr>
                        @else
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $orderItem->product->title  }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>&#8369; {{ number_format($orderItem->product->price,2) }}</td>
                                <td>&#8369; {{ $orderItem->subtotal }}</td>
                            </tr>
                       @endforeach
                       @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="payment text-end" colspan="4">Total</td>
                            <td>&#8369; {{ number_format($orderItems->sum('subtotal'),2) }}</td>
                        </tr>
                    </tfoot>
                </table>

                <p class="fw-bold fs-5 mt-5">Add-ons</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($addons->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="3">No addons found</td>
                                </tr>
                            @else
                            @foreach ($addons as $a)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $a->customizedProduct->name }}</td>
                                    <td>
                                        <p class="text-success">Free</p>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>




<script src="{{ asset('app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- JavaScript to handle the "Print" button -->
<script>
    function printReceipt() {
        var printContents = document.getElementById("invoice-POS").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Display Swal alert
        Swal.fire({
            title: "Please proceed to the cashier",
            text: "Thank you for your order!",
            imageUrl: "/img/cashier-cartoon.jpg",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image",
            confirmButtonText: "OK"
        }).then((result) => {
            // Check if the "OK" button is clicked
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop || result.dismiss === Swal.DismissReason.esc) {
                // Redirect to the menu page after clicking "OK"
                window.location.href = "{{ route('customer.landing') }}";
            }
        });
    }
</script>


@endsection
