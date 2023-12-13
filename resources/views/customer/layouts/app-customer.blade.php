<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>healTHYself</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    
   <!-- Favicon -->
   <link href="{{ asset('image/healthyself.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/style.css') }}" rel="stylesheet">
</head>
    <body>
        
    <!-- Page Wrapper -->
    
    
        <!-- Sidebar -->

        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->

    
        <!-- Main Content -->
 
            
            <!-- Page Heading -->
     
    
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
    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->
    
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
    <script> src="{{ asset('landing-page.js') }}"</script>
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
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>