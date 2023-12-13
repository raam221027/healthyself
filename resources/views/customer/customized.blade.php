@extends('customer.layouts.app-customized')

@section('contents')
<div class="modal fade" id="orderTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="orderTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="orderTypeModalLabel">Select Order Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
            </div>
            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <input type="hidden" name="listCarts" id="listCartsInput" value="[]">
                <input type="hidden" name="order_type" id="orderTypeInput" value="">
                <input type="hidden" name="payment_method" id="paymentMethodInput" value="">

                @foreach($customized_products as $product)
                    <input type="hidden" name="cp_id[]" value="{{ $product->id }}">
                @endforeach

                <div class="order-options">
                    <label>
                        <input type="radio" name="order_type" value="Dine In"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">DINE IN
                    </label>
                    <label>
                        <input type="radio" name="order_type" value="Takeout" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">TAKEOUT 
                    </label>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Payment Method</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Payment Method -->
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment_method" value="Cash" data-bs-target="#orderTypeModal3" id="proceedToReceipt" data-bs-toggle="modal"> Cash
                    </label>
                    <label>
                    <input type="radio" name="payment_method" value="GCash" data-bs-target="#orderTypeModal3" id="proceedToReceipt" data-bs-toggle="modal"> GCash
                    </label>
                </div>
            </div>
            <div class="order-type-button">
                <div class="modal-footer">
                    <i class="btn btn-primary" data-bs-target="#orderTypeModal" data-bs-toggle="modal">Back to Order Type</i>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="container">
    <div class="list">
        @foreach($customized_products as $product)
        <div class="item">
            <img src="{{ asset( $product->photo ) }}" alt="{{ $product->title }}">
            <div class="name">{{ $product->name }}</div>
            <div class="price">₱{{ $product->price }}</div>
            <div class="button" style=" position: fixed; height: 330px;">
            <button style="width: 250px; height: 330px; font-size: 24px; " onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->photo }}')"></button>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('cart')

<script src="{{ asset('app.js') }}"></script>
<script src="{{ asset('cart.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function cancelOrderAndCloseCart() {
    listCarts = []; // Clear the cart by resetting the listCarts array
    reloadCart(); // Reload the cart UI to reflect the changes
    toggleCartVisibility(false); // Close the cart
}

// Function to load cart data from local storage
function loadCartFromLocalStorage() {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        listCarts = JSON.parse(storedCart);
        reloadCart();
    }
}

// Function to save cart data to local storage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(listCarts));
}
document.getElementById('showOrderTypeModal').addEventListener('click', function () {
    if (listCarts.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Cart is Empty',
            text: 'Please add menu to your cart before placing an order.',
        });
        return;
    }
    $('#orderTypeModal').modal('show');
});
document.getElementById('proceedToReceipt').addEventListener('click', function () {
    $('#orderTypeModal').modal('hide');

    var selectedOrderType = document.querySelector('input[name="order_type"]:checked');
    var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

    if (!selectedOrderType || !selectedPaymentMethod) {
        Swal.fire({
            icon: 'error',
            title: 'Selection Missing',
            text: 'Please select both order type and payment method.',
        });
        return;
    }

    document.getElementById('orderTypeInput').value = selectedOrderType.value;
    document.getElementById('paymentMethodInput').value = selectedPaymentMethod.value;

    document.getElementById('listCartsInput').value = JSON.stringify(listCarts);
    $('form[action="{{ route ('order.place') }}"]').submit();
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your order has been placed!',
        showConfirmButton: false,
        timer: 3000
    });
});




// Add an event listener to the "Cancel Order" button
document.querySelector('.cancel-order-btn').addEventListener('click', function () {
    cancelOrderAndCloseCart(); // Call the function to cancel the order and close the cart
});

// Function to cancel the order and close the cart
function cancelOrderAndCloseCart() {
    listCarts = []; // Clear the cart by resetting the listCarts array
    reloadCart(); // Reload the cart UI to reflect the changes
    toggleCartVisibility(false); // Close the cart
    // Slide the cart back to the right side
    setTimeout(function () {
        toggleCartVisibility(true);
    }, 500); // Adjust the time (in milliseconds) as needed for your transition duration
}
</script>

@endsection
