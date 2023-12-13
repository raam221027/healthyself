<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <!-- Favicon -->
        <link href="{{ asset('image/healthyself.png') }}" rel="icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('customer_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <link href="/customer_assets/css/sb-admin-2.css" rel="stylesheet"> -->
    <!-- Inside your Blade template's <head> tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="{{ asset('customer_assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <!-- <link href="{{ asset('customer_assets/css/sb-admin-2.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('customer_assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('customer_assets/css/order_receipt.css') }}" rel="stylesheet">
    <link href="{{ asset('customer_assets/css/menu.css') }}" rel="stylesheet">
    <link  href="{{ asset('customer_assets/css/sidebar.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('admin_assets/css/styles.css') }}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('customer_assets/css/print.css') }}" media="print">

    <style>
        body {
            margin: 0;
            padding-top: 75px; /* Adjust the padding to accommodate the fixed navbar */

        }

        header {
            background-repeat:no-repeat;
            background-size:100%;
            display: inline-block;
            align-items: center;
            justify-content: center;
            position: fixed;
            width: 100%;
            margin-right:50rem;
            margin-top:-100px;
            z-index: 1000;
            transition: background-color 0.9s ease;
            height: 100px; /* Adjust the height of the header */
        }

        .header-text h1 {
            font-family: "Nunito", sans-serif;
            display: flex;
            align-items: center;
            margin-right: 20rem;
        }

        .header-text h1 span {
            font-weight: 800;
            font-size: 3rem;
        }

        .header-text img {
            width: 100px;
            height: 50px;
            border-radius: 50%;
            background: none;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .scrolled {
            background: #0f172b;
        }
    </style>
    </head>




<body>

    <body id="page-top" style="background-color: #F0F7E5;">
        
    <!-- Page Wrapper -->
    <div id="wrapper">
            <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
            </div>
    
            @yield('contents')
    
    
            </div>
            <!-- /.container-fluid -->
                
        </div>
        <!-- End of Main Content -->
    
        <!-- Footer -->
        <!-- @include('customer.layouts.footer') -->
        <!-- End of Footer -->
    
        </div>
        <!-- End of Content Wrapper -->
    
    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    
    <script src="{{ asset('cart.js') }}"></script>
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
  <!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
></script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            var header = document.getElementById("navbar");

            window.addEventListener("scroll", function () {
                if (window.pageYOffset > 0) {
                    header.classList.add("scrolled");
                } else {
                    header.classList.remove("scrolled");
                }
            });
        });
</script>


</body>
</html>