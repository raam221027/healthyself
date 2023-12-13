@extends('admin.layouts.app')


@section('contents')
<head>
   
    <link href="{{ asset('admin_dashboard_assets/css/styles.min.css') }}" rel="stylesheet">
  <style>
    /* Add custom styles here */
    .custom-container {
      margin-top: 20px;
      margin-left: 200px;
      padding: 30px;
    }
    .custom-row {
      margin-right: -10px; /* Add negative margin to compensate for column padding */
      margin-left: -10px; /* Add negative margin to compensate for column padding */
    }
    .custom-col {
      padding: 10px;
    }

    .topbar {
  height: 4.375rem;
}



  </style>
</head>

<body>

<div class="container-fluid custom-container">
    <!--  Row 1 -->
    <div class="row custom-row">
        <div class="col-lg-6 d-flex align-items-stretch custom-col">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Sales Overview</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4" style="margin-left: 68%; margin-bottom: 25px; margin-top: -30px; ">
            <div class="row">
            <div class="col-lg-10" style="width: 84%;">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Weekly Earnings</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3"><span>&#8369;</span>36,358</h4>
                            <div class="d-flex align-items-center mb-3">
                                <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-up-left text-success"></i>
                                </span>
                                <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                <p class="fs-3 mb-0">last week</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-4">
                                    <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                    <span class="fs-2">2023</span>
                                </div>
                                <div>
                                    <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                    <span class="fs-2">2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="breakup"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 custom-col" style="margin-top:30px;">
            <!-- Monthly Earnings -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                            <h4 class="fw-semibold mb-3"> <span>&#8369;</span>118,820</h4>
                            <div class="d-flex align-items-center pb-1">
                                <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-down-right text-danger"></i>
                                </span>
                                <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                <p class="fs-3 mb-0">last year</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end" >
                                <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <span>&#8369;</span>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset('customer_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('customer_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('customer_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('customer_assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('customer_assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin_dashboard_assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/js/app.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('admin_dashboard_assets/js/dashboard.js') }}"></script>
</body>


@endsection