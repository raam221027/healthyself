<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link href="{{ asset('image/healthyself.png') }}" rel="icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('customer_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <link href="/customer_assets/css/sb-admin-2.css" rel="stylesheet"> -->
    <!-- Inside your Blade template's <head> tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('customer_assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <!-- <link href="{{ asset('customer_assets/css/sb-admin-2.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('customer_assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('customer_assets/css/order_receipt.css') }}" rel="stylesheet">
    <link href="{{ asset('menu.css') }}" rel="stylesheet">
    <link href="{{ asset('customer_assets/css/landing-page.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('admin_assets/css/styles.css') }}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('customer_assets/css/print.css') }}" media="print">
 


    </head>
    <body id="page-top">
        
    <!-- Page Wrapper -->
    <div id="wrapper">
    
        <!-- Sidebar -->

        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
    
        <!-- Main Content -->
        <div id="content">
    
            <!-- Topbar -->
            
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
            
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
            </div>
    
            @yield('contents')
    
            <!-- Content Row -->
    
    
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
    <script>
const checkoutButton = document.querySelector('.checkOut .total');

checkoutButton.addEventListener('click', () => {
    const totalAmount = calculateTotalAmount();
    
    if (totalAmount > 0) {
        const paymentSuccessful = confirm(`Proceed to pay ₱${totalAmount.toLocaleString()}.00?`);
        
        if (paymentSuccessful) {
            generateReceipt();
            clearCart();
        }
    }
});

function calculateTotalAmount() {
    let totalAmount = 0;

    listCarts.forEach((value) => {
        if (value != null) {
            totalAmount += value.price * value.quantity;
        }
    });

    return totalAmount;
}

function generateReceipt() {
    let receipt = 'Receipt:\n\n';
    let receiptTotal = 0;

    listCarts.forEach((value) => {
        if (value != null) {
            const itemTotal = value.price * value.quantity;
            receipt += `${value.title} - Quantity: ${value.quantity} - Total: ₱${itemTotal.toLocaleString()}.00\n`;
            receiptTotal += itemTotal;
        }
    });

    receipt += `\nTotal Amount: ₱${receiptTotal.toLocaleString()}.00`;

    alert(receipt);
}

function clearCart() {
    listCarts = [];
    reloadCart();
}
</script>
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.btn-disable-enable');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const action = button.getAttribute('data-action');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // AJAX Request
                fetch(action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id })
                })
                .then(response => response.json())
                .then(data => {
                    // Toggle button text
                    button.innerText = data.is_disabled ? 'Enable' : 'Disable';
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>


</body>
</html>