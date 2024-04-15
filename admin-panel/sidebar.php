<style>
    .sidebar_z{
        z-index: 10 !important;
        padding-top: 66px !important;
    }
</style>
<!-- Sidebar -->
<ul class="navbar-nav new-clr sidebar sidebar_z position-fixed sidebar-light font-weight-bold accordion" id="accordionSidebar" style="transition: .3s !important;">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark ">

    <!-- Heading -->
    <div class="sidebar-heading">
        Links
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a href="categories.php" class="nav-link ">
            Categories Master
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark">

    <li class="nav-item">
        <a href="products.php" class="nav-link ">
            Product Master
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark">

    <li class="nav-item">
        <a href="categories.php" class="nav-link ">
            Order Master
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark">

    <li class="nav-item">
        <a href="users.php" class="nav-link ">
            User Master
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark">

    <li class="nav-item">
        <a href="contact.php" class="nav-link ">
            Contact Us
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider border-dark ">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.php">Login</a>
                <a class="collapse-item" href="register.php">Register</a>
                <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block border-dark">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
</ul>
<!-- End of Sidebar -->