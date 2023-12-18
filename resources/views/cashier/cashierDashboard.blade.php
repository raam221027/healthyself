@extends('cashier.layouts.app')

@section('contents')

@include('sweetalert::alert')
<i><span style="color: #a4f05c; font-weight: 800; font-size: 38px; margin-left: 16rem;">Orders</i>
<div style="overflow-x: auto; margin-left: 14%; max-width: 100%; margin-top:100px;">
<table class="table table-bordered table-hover" style="width: 100%;">
        <thead class="table-success">
            <tr>
                <th style="padding: 5px;">#</th>
                <th style="padding: 5px;">Order Number</th>
                <th style="padding: 5px;">Order Type</th>
                <th style="padding: 5px;">Payment Method</th>
                <th style="padding: 5px;">Total Amount</th>
                <th style="padding: 5px;">Status</th>
                <th style="padding: 5px;">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customerOrders->sortBy('created_at') as $order)
            <tr>
                <td style="padding: 10px;">{{ $loop->iteration }}</td>
                <td style="padding: 10px;">{{ $order->order_number }}</td>
                <td style="padding: 10px;">{{ $order->order_type }}</td>
                <td style="padding: 10px;">{{ $order->payment_method }}</td>
                <td style="padding: 10px;">₱{{ number_format($order->total_amount, 2) }}</td>
                <td style="padding: 10px;">{{ $order->status }}</td>
                <td style="padding: 10px;">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal1{{ $order->id }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2{{ $order->id }}">
                        <i class="bi bi-pen-fill"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order details</h1>
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
                                                        <th>Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td>{{ $order->order_number }}</td>
                                                        <td>{{ $item->product->title }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>₱ {{ number_format($item->product->price,2 ) }}</td>
                                                        <td>₱ {{ $item->subtotal }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                              
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <p class="fw-bold fs-4 mt-5">Customized Salad</p>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Decription</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($addons[$order->id]) && $addons[$order->id]->count() > 0)
                                                    @foreach ($addons[$order->id] as $addon)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $addon->customizedProduct->name }}</td>
                                                        <td>
                                                            <p class="text-success">Free</p>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td class="text-center" colspan="3">No addons for this order</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="payment text-end fw-bold" colspan="8">Total ₱{{ $order->total_amount }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Payment details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <form action="{{ route('order.payment', ['id' => $order->id]) }}" method="post">
                                            @csrf
                                            <div id="paymentRows">
                                                <div class="payment-row">
                                                    <div class="mb-3">
                                                        <label for="paymentMethod" class="form-label">Payment method</label>
                                                        <input type="text" readonly class="form-control payment-method"
                                                            id="paymentMethod" value="{{ $order->payment_method }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalAmount" class="form-label">Total amount</label>
                                                        <input type="number" readonly class="form-control total-amount" name="total_amount" id="totalAmount"
                                                            value="{{ $order->total_amount }}">
                                                    </div>

                                                    @if ($order->payment_method === 'Cash')
                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">Enter an amount</label>
                                                        <input type="text" class="form-control amount" name="amount"
                                                            id="amount" required>
                                                        <div class="error-text text-danger amount-error"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Change</label>
                                                        <input type="text" readonly class="form-control change" name="change"
                                                            id="change" value="0.00">
                                                    </div>
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-primary pay-now-button" type="submit"
                                                            id="payNowButton" disabled>Pay now</button>
                                                    </div>
                                                    @elseif ($order->payment_method === 'Gcash')
                                                    <div class="mb-3">
                                                    <input type="text" hidden="" class="form-control" id>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Reference number</label>
                                                        <input type="text" class="form-control" name="ref_num" id="referenceNumber"
                                                            placeholder="Enter reference number" required>
                                                    </div>
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-primary" type="submit">Pay now</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $customerOrders->render() }}
</div>
</div>
@endsection