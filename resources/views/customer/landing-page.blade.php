@extends('customer.layouts.app-without-sidebar')


@section('title', '')

@section('contents')
<style>
  html {
    scroll-behavior: smooth;
  }

  /* Style for the fixed navbar */
.navbar-fixed {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
}

/* Style for the "Start Order" button when it appears */
#start-order-btn.visible {
    display: block;
    position: flex;
    opacity: 1;
    transform: translateY(0); /* Reset transform */
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Style for the "Start Order" button when it's hidden */
#start-order-btn.hidden {
    display: block;
    opacity: 0;
    transform: translateY(50px); /* Move the button 50px down */
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.start-order-container {
    position: flex;
    top: 0;
    right: 0;
    padding: 10px 20px;
    z-index: 1000;
}

/* Style for the "Start Order" button */
#start-order-btn {
    display: block;
    text-align: center;
}


  /* Common styles for both desktop and tablet */
  #v-pills-tab {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100%;
    padding: 0;
    margin-left: 40rem;
  }

  .nav-link {
    text-decoration: none;
    color: #333;
    display: block;
  }

  /* Styling for the icons and text */
  .nav-link i {
    margin-right: 10px;
  }

  .nav-link span {
    font-size: 12x;
  }



</style>

<body>

<div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
</div>        
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-white m-0 " > <img src="img/lettuce.png"  class="me-3" style="border-radius:50%;"></i>heal<span style="color: #a4f05c;">THY</span>self</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="navbar-nav ms-auto py-0 pe-2">
            <a href="#menu" class="nav-item nav-link" style="font-size:17px; right:20%;">Menu</a>
            <a href="#best-seller" class="nav-item nav-link" style="font-size:17px; right:15%;">Best Seller</a>
        </div>
        <div class="start-order-container py-0 pe-0">
            <a href="{{ route('customer.dashboard') }}" class="btn custom-btn py-2 px-4" id="start-order-btn">Start Order</a>
        </div>
    </nav>
</div>

<div class="container-xxl py-5 hero-header mb-5">
    <div class="container my-5 py-5">
    <div class="row justify-content-center">
            <div class="col-lg-6 text-center text-lg-start"  style="max-width: 984px; height: 600px;">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">Fresh Vibrant Vegetables, Fruits & Salads 🥗🍅🌱</p>
                <a href="{{ route('customer.dashboard') }}" class="btn custom-btn py-sm-3 px-sm-5 me-3 animated slideInLeft">Start Order</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/spinning-menu.png" alt="">
            </div>
        </div>
    </div>
</div>


        <!-- Best Seller Start -->
        <div id="menu" class="container-xxl" style="margin-top:-50px;">
             <!-- Offset div -->
             <div style="height: 70px;"></div>
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="section-title ff-secondary text-center text-primary fw-normal mb-3">Menu</h2>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                            <img src="img/salad1.png" style="width: 75px; height: auto;">
                                <div class="ps-3">
                                    <small class="text-body"></small>
                                    <h6 class="mt-n1 mb-0">Entrées</h6>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                            <img src="img/smoothie.png" style="width: 75px; height: auto;">
                                <div class="ps-3">
                                    <small class="text-body"></small>
                                    <h6 class="mt-n1 mb-0">Smoothie</h6>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                            <img src="img/juices.png" style="width: 75px; height: auto;">
                                <div class="ps-3">
                                    <small class="text-body"></small>
                                    <h6 class="mt-n1 mb-0">Beverages</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/30.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Roast Beef Sandwich</span>
                                                <span class="text-primary">₱245</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/34.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Sandwich</span>
                                                <span class="text-primary">₱225</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/40.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Bruschetta Sandwich</span>
                                                <span class="text-primary">₱225</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/41.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Cream Cheese Pesto</span>
                                                <span class="text-primary">₱245</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-5.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Spinach and Mushroom</span>
                                                <span class="text-primary">₱245</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-6.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>King Kale-Sadillas</span>
                                                <span class="text-primary">₱245</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-7.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Aglio Olio Shrimps</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Pesto Pasta</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Spinach Carbonara</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Shrimp Marinara</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-5.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-6.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">₱115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-7.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Chicken Burger</span>
                                                <span class="text-primary">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
        
        <!-- Best Seller Section -->
<div id="best-seller" class="container-xxl py-5">
     <!-- Offset div -->
     <div style="height: 50px;"></div>
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row g-5">
                            <div class="col-6 text-start" style="position: relative; ">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="img/bs-4.jpg">
                                <img class="wow zoomIn" data-wow-delay="0.1s" src="img/best-seller.png" style="width: 50px;  position: absolute; top: 10px; left: -20px;">
                            </div>
                            <div class="col-6 text-start" style="position: relative;">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/bs-5.jpg" style="margin-top: 25%;">
                                <img class="wow zoomIn" data-wow-delay="0.1s" src="img/best-seller.png" style="width: 40px;  position: absolute; top: 70px; left: -10px;">
                            </div>
                            <div class="col-6 text-start" style="position: relative;">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/bs-6.jpg" style="margin-left: 25%;">
                                <img class="wow zoomIn" data-wow-delay="0.1s" src="img/best-seller.png" style="width: 40px;  position: absolute; top: 10px; left: 50px;">
                            </div>
                            <div class="col-6 text-start" style="position: relative;">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="img/bs-7.jpg">
                                <img class="wow zoomIn" data-wow-delay="0.1s" src="img/best-seller.png" style="width: 50px;  position: absolute; top: 10px; left: -20px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <h2 class="section-title ff-secondary text-start text-primary fw-normal">Best Seller</h2>
                        <!-- <h1 class="mb-4"></i>heal<span style="color: #81B233;">THY</span>self</h1> -->
                        <p class="mb-4">Here's our most popular menu give it a try!</p>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center border-start border-5 px-3" style="border-color:  #a4f05c !important;">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">4</h1>
                                <div class="ps-4">
                                    <p class="mb-0">Best</p>
                                    <h6 class="text-uppercase mb-0">Seller</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 px-3"           style="border-color:  #a4f05c !important;">
                                    <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">24</h1>
                                    <div class="ps-4">
                                        <p class="mb-0">Fresh</p>
                                        <h6 class="text-uppercase mb-0">Menu</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Best Seller End -->
        


 


    <!-- Footer Start -->
      
        <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-1">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-4 ">
                        &copy; <a href="" style="color:  #a4f05c;">healTHYself</a>. All Right Reserved.
                    </div>
                  
                    <!-- <div class="col-md-6 text-center text-md-end">
                        /*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div> -->
                </div>
            </div>
    <!-- Footer End -->

     <!-- Back to Top -->
     <div style="height: 30px;"></div>  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-center position-relative" id="offcanvasRightLabel">
            <i class="fas fa-cart-plus text-primary fa-2x"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <span id="cart-count">0</span>
                <span class="visually-hidden">unread messages</span>
            </span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th class="fw-bold" scope="col">#</th>
                    <th class="fw-bold" scope="col">Title</th>
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
            <p class="mt-4 fw-bold fs-4">Customized</p>
                <table class="table">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
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
                            <div class="col">
                            <p class="text-start fw-bold fs-5">Order type:</p>
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
                                <p class="text-start fw-bold fs-5">Payment method:</p>
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
                        <button class="btn btn-outline-success" id="saveBtn" type="button" data-route="{{ route('order.place') }}">Place Order</button>
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



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('customer_assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('customer_assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('customer_assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('customer_assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer_assets/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('customer_assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

<script>
    // Function to show or hide the "Start Order" button
    function toggleStartOrderButton() {
        var startOrderBtn = document.getElementById('start-order-btn');
        if (window.scrollY > 370) { // Adjust the scroll position as needed
            startOrderBtn.classList.remove('hidden');
            startOrderBtn.classList.add('visible');
        } else {
            startOrderBtn.classList.remove('visible');
            startOrderBtn.classList.add('hidden');
        }
    }

    // Add an event listener to the window for scroll events
    window.addEventListener('scroll', toggleStartOrderButton);

    // Initial call to set the button's initial state
    toggleStartOrderButton();
</script>



</body>
@endsection
