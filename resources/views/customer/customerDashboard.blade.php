@extends('customer.layouts.app')

@section('contents')
<!-- Modal 1 -->
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
    <div class="modal-body">
    <!-- Order Type -->
    <div class="order-options">
        <label>
            <button type="button" name="order_type" value="Dine In" class="btn btn-outline-primary"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">DINE IN</button>
        </label>
        <label>
            <button type="button" name="order_type" value="Takeout" class="btn btn-outline-primary"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">TAKEOUT</button>
        </label>
    </div>
</div>  <!-- Show a second modal and hide this one with the button below. -->
      </form>
  


            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Proceed to Payment Method</button>  -->
                <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" id="proceedToReceipt" data-bs-toggle="modal">Proceed to Payment Method</button> -->
                <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" id="proceedToReceipt" data-bs-toggle="modal">Proceed to Receipt</button> -->
                <!-- <button type="button" class="btn btn-primary" id="proceedToReceipt">Proceed to Receipt</button> -->

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
            <button type="button" name="payment_method" value="Cash" class="btn btn-outline-primary" data-bs-target="#orderTypeModal3" id="proceedToReceipt" data-bs-toggle="modal">Cash</button>
            </label>
            <label>
            <button type="button" name="payment_method" value="GCash" class="btn btn-primary" data-bs-target="#exampleModalToggle2" id="proceedToReceipt" data-bs-toggle="modal">GCash</button>
        </label>
    </div>    
    </div>
    <div class="order-type-button">
      <div class="modal-footer">
       <i class="btn btn-primary" data-bs-target="#orderTypeModal" data-bs-toggle="modal" >Back to Order Type</i>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal 3 -->
<div class="modal fade custom-modal" id="orderTypeModal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="orderTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="orderTypeModalLabel3">Modal 3</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div id="invoice-POS" style="width:100%;">
      <div class="modal-body">
      <center id="top">
      <div class="logo">
          <img src="{{ asset('image/healthyself.png') }}" alt="Logo" style=" width: 50%;"></div>
      <div class="info"> 
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
            Address : 2nd Floor Ayala Centrio Mall</br> 9000 Cagayan de Oro, Philippines</br>
            Email   : healthyselfcdo@gmail.com</br>
            Phone   : 0917 757 9612</br>
        </p>
   
					
        <div class="tabletitle">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Order No.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newOrders as $order)
            <tr>
                <td colspan="4">
                    {{ $order->order_number }}
                    <!-- Other order details as needed -->
                </td>
            </tr>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>₱{{ $item->price }}</td>
                <td>₱{{ $item->pivot->quantity * $item->price }}</td>
                <td>₱{{ $order->totalAmount() }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>


					<div id="legalcopy">
						<p class="legal"><strong>Thank you for your order!</strong></p>
					</div>
                    </div></div>
    </div>  
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#orderTypeModal" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
<!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button> -->
    <div class="container">
        <div class="list">
        @foreach($products as $product)
            <div class="item">
                <img src="{{ asset('storage/' . $product->photo) }}">
                <div class="title">{{ $product->title }}</div>
                <div class="price">₱{{ $product->price }}.00</div>
                
                <div class="button">
                <button onclick="addToCart({{ $product->id }}, '{{ $product->title }}', {{ $product->price }}, '{{ $product->photo }}')">BUY</button>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    
    <div class="cart">
        <header>
            <div class="shopping">
                <img src="/image/shopping.svg">
                <span class="quantity">0</span>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        

        document.getElementById('showOrderTypeModal').addEventListener('click', function() {
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

    document.getElementById('proceedToReceipt').addEventListener('click', function(event) {
    if (listCarts.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Cart is Empty',
            text: 'Please add menu to your cart before placing an order.',
        });
        return;
    }

    event.preventDefault(); // Prevent the form from submitting immediately

    $('#orderTypeModal').modal('hide');

    document.getElementById('listCartsInput').value = JSON.stringify(listCarts); // Store listCarts in the hidden input

    // Submit the form using AJAX
    $.ajax({
        type: 'POST',
        url: $('form[action="{{ route('order.place') }}"]').attr('action'),
        data: $('form[action="{{ route('order.place') }}"]').serialize(),
        success: function(response) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your order has been placed',
                showConfirmButton: false,
                timer: 1500
            });
            // Optionally, you can perform any actions you want after a successful submission here
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'An error occurred',
                text: 'Sorry, your order could not be placed at this time.',
            });
        }
    });
});

    </script>
@endsection