<div class="cart">
    <header>
        <div class="shopping">
            <img src="/image/shopping.svg">
            <span class="quantity" id="cartQuantity">0</span>
        </div>
    </header>
    <h1>Cart</h1>
    <div class="listCart">
        <!-- Cart items will be dynamically added here -->
    </div>

    <div class="total" id="totalAmount">Total: ₱ 0</div>
    <div class="checkOut">
        <button type="button" class="place-order-btn" id="showOrderTypeModal">Place Order</button>
        <button type="cancel" class="cancel-order-btn">Cancel Order</button>
    </div>
</div>

<script src="{{ asset('app.js') }}"></script>
<script src="{{ asset('cart.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Your cart-related JavaScript code here
</script>
