@extends('customer.layouts.app')

@section('contents')

<div id="invoice-POS">
    
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
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">
        <div class="order-type">
            @if ($order)
                <p>Order Type: {{ $order->order_type }}</p>
            @else
                <p>Order Type: Not available</p>
            @endif
        </div>
    </div>
					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
                                <!-- <td></td> -->
								<td class="Hours"><h2>Qty</h2></td>
								<td class="Rate"><h2>Sub Total</h2></td>
							</tr>
                            @if ($order)
						    @foreach ($order->orderItems as $item)
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">{{ $item->product->title }}</p></td>
                                    <td class="tableitem"><p class="itemtex">&nbsp&nbsp&nbsp&nbsp&nbsp{{ $item->quantity }}</p></td>
                                    <td class="tableitem"><p class="itemtext">&nbsp&nbsp&nbsp&nbsp&nbsp₱{{ $item->subtotal }}</p></td>
                                </tr>
                            @endforeach
                            @else
                                <p>No order data available.</p>
                            @endif


							<!-- <tr class="tabletitle">
								<td></td>
								<td class="Rate"><h2>tax</h2></td>
                                <td class="payment"><h2>₱{{ $order->tax }}</h2></td>
							</tr> -->

							<tr class="tabletitle">
								<td></td>
                                <td class="payment"><h2>Total ₱{{ $order->total_amount }}</h2></td>
							</tr>
						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank you for your order!</strong></p>
					</div>



  <script src="{{ asset('app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

