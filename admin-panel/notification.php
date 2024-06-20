<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
} else {
}
include("connection.php");

?>
<?php include("top_page.php"); ?>
<?php include("sidebar.php"); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="row m-0 most_margin">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <!-- Main Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Notifications</h1>
                    </div>
                    <?php
                    $query = mysqli_query($connection, "SELECT * FROM users_notification WHERE status = 'unseen'");
                    $noti = "";
                    if (mysqli_num_rows($query) > 0) {
                        $noti = "show";
                    }
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-12 mb-2">
                            <form method="POST">
                                <button type="submit" name="btn_user_notification" class="text-decoration-none btn w-100 p-0">
                                    <div class="card notification_div border-left-primary shadow h-100 p-4 d-flex">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Users Notifications</div>
                                        <div class="notification_dot <?php echo $noti; ?> user_notification"></div>
                                    </div>
                                </button>
                            </form>
                            <?php 
                                if(isset($_POST['btn_user_notification'])){
                                    $update= "update_user";
                                    echo "<script>window.location.href= 'user_notification.php?message=$update'</script>";
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <?php
                    $query = mysqli_query($connection, "SELECT * FROM contact_notification WHERE status = 'unseen'");
                    $noti = "";
                    if (mysqli_num_rows($query) > 0) {
                        $noti = "show";
                    }
                    ?>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-12 mb-2">
                            <form method="POST">
                                <button type="submit" name="btn_contact_notification" class="text-decoration-none btn w-100 p-0">
                                    <div class="card notification_div border-left-primary shadow h-100 p-4 d-flex">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Contact Notifications</div>
                                        <div class="notification_dot <?php echo $noti; ?> contact_notification"></div>
                                    </div>
                                </button>
                            </form>
                            <?php 
                                if(isset($_POST['btn_contact_notification'])){
                                    $update= "update_contact";
                                    echo "<script>window.location.href= 'contact_notification.php?message=$update'</script>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                    $query = mysqli_query($connection, "SELECT * FROM order_notification WHERE status = 'unseen'");
                    $noti = "";
                    if (mysqli_num_rows($query) > 0) {
                        $noti = "show";
                    }
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-12 mb-2">
                            <form method="POST">
                                <button type="submit" name="btn_order_notification" class="text-decoration-none btn w-100 p-0">
                                    <div class="card notification_div border-left-primary shadow h-100 p-4 d-flex">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Order Notifications</div>
                                        <div class="notification_dot <?php echo $noti; ?> order_notification"></div>
                                    </div>
                                </button>
                            </form>
                            <?php 
                                if(isset($_POST['btn_order_notification'])){
                                    $update= "update_order";
                                    echo "<script>window.location.href= 'order_notification.php?message=$update'</script>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Main Page Content -->
            </div>
        </div>

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php"); ?>