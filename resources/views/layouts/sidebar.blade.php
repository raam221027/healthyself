
<ul class="navbar-nav bg-sheen-green sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- ... Sidebar content ... -->

    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('adminDashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        
    </div>
    <div  class="sidebar-brand-text mx-3">healTHYself <sup>2023</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('adminDashboard') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('products') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Products</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('users') }}">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Users</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Reports</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>

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