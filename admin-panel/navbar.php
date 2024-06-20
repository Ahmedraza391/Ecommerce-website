<style>
    .navbar_z{
        z-index: 11 !important;
    }
    .most_margin{
        margin-top: 100px !important;
    }
</style>
<!-- Topbar -->
<nav class="navbar navbar_z position-fixed w-100 navbar-expand navbar-light bg-white topbar mb-4 static-top ">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand d-flex align-items-center font-weight-bold justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?php
                $dot = "";
                $user_query = mysqli_query($connection,"SELECT * FROM users_notification WHERE status = 'unseen' ");
                if(mysqli_num_rows($user_query)>0){
                    $dot = "show";
                }
                $order_query = mysqli_query($connection,"SELECT * FROM order_notification WHERE status = 'unseen' ");
                if(mysqli_num_rows($order_query)>0){
                    $dot = "show";
                }
                $contact_query = mysqli_query($connection,"SELECT * FROM contact_notification WHERE status = 'unseen' ");
                if(mysqli_num_rows($contact_query)>0){
                    $dot = "show";
                }
            ?>
            <a href="notification.php" class="nav-link text-primary"><i class="fas fa-bell h5 m-0"></i><div class="notification_dot <?php echo $dot; ?>"></div></a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" style="margin-right: 10px;"
                    src="img/undraw_profile.svg">
                <i class="fas fa-chevron-down"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin_profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->