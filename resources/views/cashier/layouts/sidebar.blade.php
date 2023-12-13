<style>
    .nav-item:hover .nav-link {
        background-color: #81B233;
        color: white; /* Change text color to white on hover */
        transition: background-color 0.3s, color 0.3s; /* Add transition effect for both background color and text color */
}
.sidebar {
        transition: margin-left 0.5s;
        margin-left: 0; /* Sidebar initially closed */
        position: fixed;
    }

    .content-area {
        transition: margin-left 0.5s;
        margin-left: 250px; /* Adjust this width based on your sidebar width */
    }

    .sidebar-closed {
        margin-left: -250px; /* Negative value equal to sidebar width */
    }

    @media (max-width: 768px) {
        .sidebar {
            margin-left: -250px; /* Keep the sidebar closed on small screens */
        }

        .content-area {
            margin-left: 0; /* Content area fully visible */
        }

        .sidebar-mobile-open {
            margin-left: 0 !important; /* Override for mobile view */
        }
    }

    /* Add this style to give the footer a fixed height */
    footer {
        height: 60px; /* Adjust the height as needed */
    }

</style>
<div class="sidebar" style="z-index:1050;">
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0f172b; z-index:100;">
            <img src="{{ asset('image/healthyself.png') }}" alt="Logo Image" style="width: 75px; height: 70px; margin-left:5rem; margin-top:1rem; border-radius:50%;">
    <!-- ... Sidebar content ... -->


    <!-- Sidebar - Brand -->


    <!-- Divider -->
    <hr class="sidebar-divider my-2" style="padding-top: 20px;">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item">
    <a class="nav-link"  href="{{ route('cashierDashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
    </li> -->

    <li class="nav-item">
    <a class="nav-link"href="{{ route('cashierDashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Orders</span></a>
    </li>
   
  

    <li class="nav-item">
    <a class="nav-link" href="{{ route('cashier.daily_sales_report') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Reports</span></a>
    </li>


    <!-- Divider -->

    <hr class="sidebar-divider my-2">

<li class="nav-item">
<a class="nav-link" href="{{ route('logout') }}">
<i class="fas fa-fw fa-sign-out-alt"></i>
<span>Logout</span></a>
</li>
<hr class="sidebar-divider d-none d-md-block">


    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->


</ul>
</div>

<!-- Add classes to adjust the main content area when the sidebar is open/closed -->

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
