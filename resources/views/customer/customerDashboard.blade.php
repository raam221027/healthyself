@extends('customer.layouts.app')

@section('contents')
<style>
  /* Common styles for both desktop and tablet */
  #v-pills-tab {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100%;
    background-color: #f2f2f2;
    padding: 0;
  }

  .nav-link {
    text-decoration: none;
    color: #333;
    margin-bottom: 20px;
    display: block;
    padding: 5px;
  }

  /* Styling for the icons and text */
  .nav-link i {
    margin-right: 20px;
  }

  .nav-link span {
    font-size: 14px;
  }
</style>

<div class="d-flex align-items-start" style="margin-left: 30%;">
  <!-- Vertical Navigation Menu -->
  <div class="nav flex-column nav-pills me-3 bg-light" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <!-- Menu Tab -->
    <button class="nav-link active text-primary fw-bold fs-6" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
      <i class="fas fa-bars"></i>
      Menu
    </button>

    <!-- Make Your Own Salad Tab -->
    <button class="nav-link text-primary fw-bold fs-7" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
      <i class="fas fa-leaf"></i>
      Make your own salad
    </button>
  </div>

 <!-- Tab Content -->
 <div class="tab-content" id="v-pills-tabContent">
    <!-- Menu Tab Content -->
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
        <div class="container ">
            <div class="row">
                @foreach ($products as $p)
                <div class="col-md-4">
                    <div class="card product mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-product-id="{{ $p->id }}" style="width: 18rem; margin-left: 100px; height: 40vh;">
                        <div class="d-flex flex-column bg-image hover-overlay hover-zoom hover-shadow ripple">
                            <img src="{{ asset('' . $p->photo) }}" class="card-img-top mx-auto" alt="..." style="height: 25vh">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $p->title }}</h5>
                                <p class="card-text text-center fs-6">&#8369; {{ number_format($p->price, 2) }}</p>
                            </div>
                            <div class="mask" style="background-color: hsla(195, 83%, 58%, 0.2)"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Make Your Own Salad Tab Content -->
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
      <div class="container">
        <div class="row">
            @foreach ($salad as $s)
            <div class="col-md-4">
                <div class="card salad mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-salad-id="{{ $s->id }}" style="width: 18rem; margin-left: 100px; height: 40vh;">
                    <div class="d-flex flex-column bg-image hover-overlay hover-zoom hover-shadow ripple">
                        <img src="{{ asset('' . $s->photo) }}" class="card-img-top mx-auto" alt="..." style="height: 25vh">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $s->name }}</h5>
                            <p class="card-text text-center text-success"></p>
                        </div>
                        <div class="mask" style="background-color: hsla(195, 83%, 58%, 0.2)"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>


<div class="position-fixed end-0 top-0" style="margin-top: 8px; margin-right: 30px; z-index: 1050;">
    <button type="button" class="btn btn" style="background: none; border: none; padding: 0;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
    <img src="/img/food-service.png" width="50" height="50" alt="Small Food Service Image"></img>
        <span class="badge bg-danger" id="cart-count">0</span>
    </button>
</div>


<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th class="fw-bold" scope="col">#</th>
                    <th class="fw-bold" scope="col">Product</th>
                    <th class="fw-bold" scope="col">Price</th>
                    <th class="fw-bold text-center" scope="col">Quantity</th>
                    <th class="fw-bold" scope="col">Subtotal</th>
                    <th class="fw-bold" scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="cart-table-body">
            </tbody>
        </table>
        
        <div class="table-responsive">
            <p class="mt-4 fw-bold fs-5">Customized Salad</p>
                <table class="table">
                    <thead class="table-success">
                        <tr>
                            <th class="fw-bold" scope="col">#</th>
                            <th class="fw-bold" scope="col">Product</th>
                            <th class="fw-bold" scope="col">Description</th>
                            <th class="fw-bold" scope="col"></th>
                            <th></th>
                            <th class="fw-bold" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="salad-info">
                    </tbody>
                    
                </table>
                <div id="no-salad-label" class="text-center mb-5">No salad information</div>
                
        </div>
        <div class="container">
            <div class="card shadow-lg bg-light">
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col p-1">
                            <p class="text-center fw-bold fs-5">Order type</p>
                                    <!-- DINE IN -->
                                <div class="form-check form-check-inline customCheckBoxHolder" id="orderType">
                                <input type="checkbox" name="orderType" id="dineIn" value="Dine In" class="customCheckBoxInput">
                                <label for="dineIn" class="customCheckBoxWrapper">
                                    <div class="customCheckBox">
                                        <div class="inner">Dine In</div>
                                    </div>
                                </label>
                            </div>

                            <!-- TAKE OUT -->
                            <div class="form-check form-check-inline customCheckBoxHolder" id="orderType">
                                <input type="checkbox" name="orderType" id="takeOut" value="Take Out" class="customCheckBoxInput">
                                <label for="takeOut" class="customCheckBoxWrapper">
                                    <div class="customCheckBox">
                                        <div class="inner">Take Out</div>
                                    </div>
                                </label>
                            </div>
                            </div>
                            
                            <div class="col">
                                <p class="text-center fw-bold fs-5">Payment method</p>
                             <!-- Cash Payment Method -->
                            <div class="form-check form-check-inline customCheckBoxHolder" id="paymentMethod">
                                <input type="checkbox" name="paymentMethod" id="cash" value="Cash" class="customCheckBoxInput">
                                <label for="cash" class="customCheckBoxWrapper">
                                    <div class="customCheckBox">
                                        <div class="inner">Cash</div>
                                    </div>
                                </label>
                            </div>

                            <!-- Gcash Payment Method -->
                            <div class="form-check form-check-inline customCheckBoxHolder" id="paymentMethod">
                                <input type="checkbox" name="paymentMethod" id="gcash" value="Gcash" class="customCheckBoxInput">
                                <label for="gcash" class="customCheckBoxWrapper">
                                    <div class="customCheckBox">
                                        <div class="inner">GCash</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-outline-success" id="saveBtn" type="button" data-route="{{route('order.place') }}">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
$(document).ready(function() {
    // When an order type radio button is clicked
    $('input[name="orderType"]').on('change', function() {
        // Uncheck other order type radio buttons
        $('input[name="orderType"]').not(this).prop('checked', false);
    });
    
    // When a payment method radio button is clicked
    $('input[name="paymentMethod"]').on('change', function() {
        // Uncheck other payment method radio buttons
        $('input[name="paymentMethod"]').not(this).prop('checked', false);
    });
});
</script>



</html>

@endsection