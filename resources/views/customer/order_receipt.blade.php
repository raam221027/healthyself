@extends('customer.layouts.app-order-receipt')
@section('contents')
<div class="container d-flex align-items-center justify-content-center">
    <div class="card col-md-8 mb-3" id="invoice-POS">
        <div class="card-body">
            <h2 class="text-center">ORDER SLIP</h2>
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
                                    <td>{{ $orderItem->product->title }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>&#8369; {{ number_format($orderItem->product->price, 2) }}</td>
                                    <td>&#8369; {{ $orderItem->subtotal }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <p class="fw-bold fs-5 mt-5">Customized Salad</p>
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Order #</th>
                            <th>Product</th>
                            <th>Description</th>
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
                                        <p class="text-success">Toppings</p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="payment text-end" colspan="2">Total</td>
                            <td>&#8369; {{ number_format($orderItems->sum('subtotal'), 2) }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div id="legalcopy" style="margin-left: 35%; text-align: center;">
                    <p class="legal" style="margin-right: 50%;"><strong>Print your order slip</strong></p>
                    <button onclick="printReceipt()" id="printButton" class="btn btn-primary mb-3" style="margin-right: 50%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path
                                d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg> Print Receipt
                    </button>
                </div>
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

<script>
      // Calculate the overall total using the calculateTotalPrice function
      const saladIds = otherData.saladIds; // Assuming you have saladIds in your other data
        const saladPrice = 285; // Fixed price for salad

        const products = otherData.selectedProducts; // Assuming you have selectedProducts in your other data
        const overallTotal = calculateTotalPrice(products, saladIds, saladPrice);

        console.log('Overall Total:', overallTotal);

        // Update your HTML content or perform other operations with the overall total
        // For example, you can update a specific element with the total value
        document.getElementById('overall-total').innerText = `Overall Total: ${overallTotal.toLocaleString()}`;
</script>

@endsection
