<style>
   header {
            background-color:#0f172b;
            background-repeat:no-repeat;
            background-size:100%;
            display: flex;
            align-items: center;
            justify-content: left;
            position: fixed;
            margin-left:-3%;
            width: 110%;
            margin-top:-5px;
            z-index: 1000;
            transition: background-color 0.9s ease;
            backdrop-filter: blur(10px); /* Add backdrop filter for blur effect */
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: none;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .scrolled {
            background: #0f172b;
        }
    </style>

     <!-- Header -->
    <header id="navbar">
    <div class="header-text text-center">
        <h1 style="color: #fff; font-size: 50px; font-weight: 800; margin-left:13rem;">
            <i>heal<span style="color: #a4f05c; font-weight: 800;">THY</span>self</i>
        </h1>
    </div>
</header>

</div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Nav Item - Alerts -->


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-light small">

          <large>{{ auth()->user()->role }}</large>
          <br>
          {{ auth()->user()->name }}

        </span>
        <img class="img-profile rounded-circle" src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('cashier.profile') }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf

        </form>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>