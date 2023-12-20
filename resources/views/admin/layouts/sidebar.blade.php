<style>
    .nav-item:hover .nav-link {
        background-color:#81B233;
        color: white; /* Change text color to white on hover */
        transition: background-color 0.3s, color 0.3s; /* Add transition effect for both background color and text color */
}


    /* Add this style to give the footer a fixed height */
    footer {
        height: 60px; /* Adjust the height as needed */
    }

</style>
<div class="sidebar">
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0f172b; z-index:100;">
            <img src="{{ asset('image/healthyself.png') }}" alt="Logo Image" style="width: 75px; height: 70px; margin-left:5rem; margin-top:1rem; border-radius:50%;">
    <!-- ... Sidebar content ... -->


    <!-- Sidebar - Brand -->


    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="padding-top: 20px;">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link"  href="{{ route('adminDashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Products</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('products') }}">Ready Made Products</a>
                        <a class="collapse-item" href="{{ route('customized_products.index') }}">Customize Products</a>
                    </div>
                </div>
            </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('users') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Users</span></a>
    </li>


    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
                aria-expanded="true" aria-controls="collapseReports">
                <i class="fas fa-fw fa-table"></i>
                <span>Reports</span>
            </a>
            <div id="collapseReports" class="collapse" aria-labelledby="headingReports" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.daily_sales_report') }}">Sales Report</a>
                    <a class="collapse-item" href="{{ route('admin.product_sold_report') }}">Product Sold Report</a>
                </div>
            </div>
        </li>




    <hr class="sidebar-divider my-2">

    <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}">
    <i class="fas fa-fw fa-sign-out-alt"></i>
    <span>Logout</span></a>
    </li>


    


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->


</ul>
</div>

<!-- Add classes to adjust the main content area when the sidebar is open/closed -->
<div class="content-area">
    <!-- ... Main content ... -->
</div>
<script>
    // Add JavaScript to handle sidebar toggling
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('sidebar-closed');
        document.querySelector('.content-area').classList.toggle('sidebar-closed');
    });

    // Add JavaScript to handle sidebar toggling in mobile view
    window.addEventListener('resize', function() {
        if (window.innerWidth < 768) {
            document.querySelector('.sidebar').classList.add('sidebar-mobile-open');
        } else {
            document.querySelector('.sidebar').classList.remove('sidebar-mobile-open');
        }
    });
</script>
