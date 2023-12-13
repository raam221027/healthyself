
<style>
   header {
            background-color:#0f172b;
            background-repeat:no-repeat;
            background-size:100%;
            display: flex;
            justify-content: left;
            position: fixed;
            margin-left:10rem;
            width: 100%;
            margin-top:-5px;
            z-index: 1050;
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
        .topbar-divider {
        border-right: 1px solid #fff;
        height: 50px; /* Adjust the height as needed */
        margin: 0 10px;
    }

    .navbar-nav.ml-auto {
        display: flex;
        align-items: left;
    }

    .nav-link {
        color: #fff;
    }

    .nav-link:hover {
        color: #a4f05c;
    }

    .img-profile {
        width: 30px; /* Adjust the size as needed */
        height: 30px; /* Adjust the size as needed */
        border-radius: 50%;
    }

    .dropdown-toggle::after {
        display: none; /* Hide the default dropdown caret */
    }

    .profile-dropdown {
        position: relative;
        z-index: 1051; /* Adjust the z-index to be higher than the navbar */
    }
</style>


     <!-- Header -->
<header id="navbar">
    <div class="header-text">
        <h1 style="color: #fff; font-size: 50px; font-weight: 800;">
            <i>heal<span style="color: #a4f05c; font-weight: 800;">THY</span>self</i>
        </h1>
    </div>
</header>





  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-5">

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
