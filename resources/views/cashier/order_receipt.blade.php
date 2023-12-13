    @extends('cashier.layouts.app')

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
            <p>Order Type: {{ $order->order_type }}</p>
            <p>Payment Method: {{ $order->payment_method }}</p>
        </div>

        </div>
        <div class="tabletitle">
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            &nbsp&nbsp&nbsp&nbsp&nbsp
                            
                                @foreach ($order->orderItems as $item)
                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">{{ $order->order_number }}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{ $item->product->title }}</p></td>
                                        <td class="tableitem"><p class="itemtext">&nbsp&nbsp&nbsp&nbsp&nbsp{{ $item->quantity }}</p></td>
                                        <td class="tableitem"><p class="itemtext">&nbsp&nbsp&nbsp&nbsp&nbsp₱{{ $item->product->price }}</p></td>
                                        <td class="tableitem"><p class="itemtext">&nbsp&nbsp&nbsp&nbsp&nbsp₱{{ $item->subtotal }}</p></td>
                                    </tr>
                                @endforeach
  
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
        <script src="{{ asset('app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @endsection

