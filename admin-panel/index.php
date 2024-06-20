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
            <div class="col-md-2 "></div>
            <div class="col-md-10">
                <!-- Main Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card p-4">
                                <h6 class="text-info font-weight-bold ">Overall</h6>
                                <div class="row">
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $order_query = mysqli_query($connection, "SELECT order_details.*,user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id");
                                        $order_count = mysqli_num_rows($order_query);
                                        ?>
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $products = mysqli_query($connection, "SELECT * FROM products WHERE status  = 1");
                                        $products_count = mysqli_num_rows($products);
                                        ?>
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Prdoucts</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $products_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $user = mysqli_query($connection, "SELECT * FROM users");
                                        $user_count = mysqli_num_rows($user);
                                        ?>
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users</div>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-auto">
                                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $user_count; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $earning = mysqli_query($connection, "SELECT SUM(user_order.total_price) as 'total_earnings',user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id WHERE user_order.order_status = 'delivered'");
                                        $total_earnings = "";
                                        if($earning){
                                            $fetch = mysqli_fetch_assoc($earning);
                                            if($fetch){
                                                $total_earnings = $fetch['total_earnings'];
                                            }else{
                                                $total_earnings = "0";
                                            }
                                        }
                                        ?>
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Earnings</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rs <?php echo $total_earnings ?>/-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card p-4">
                                <h6 class="text-info font-weight-bold ">All Orders</h6>
                                <div class="row order_row">
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $order_query = mysqli_query($connection, "SELECT order_details.*,user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id WHERE user_order.order_status = 'delivered'");
                                        $order_count = mysqli_num_rows($order_query);
                                        ?>
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered Orders</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <!-- for cancelled orders -->
                                        <?php
                                        $order_query = mysqli_query($connection, "SELECT order_details.*,user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id WHERE user_order.order_status = 'cancelled'");
                                        $order_count = mysqli_num_rows($order_query);
                                        ?>
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancelled Orders</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $order_query = mysqli_query($connection, "SELECT order_details.*,user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id WHERE user_order.order_status = 'shipped'");
                                        $order_count = mysqli_num_rows($order_query);
                                        ?>
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Shipped Orders</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 mt-md-0">
                                        <?php
                                        $order_query = mysqli_query($connection, "SELECT order_details.*,user_order.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id WHERE user_order.order_status = 'pending'");
                                        $order_count = mysqli_num_rows($order_query);
                                        ?>
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Orders</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card p-4">
                                <h6 class="text-info font-weight-bold ">All Products</h6>
                                <div class="row order_row">
                                    <div class="col-md-6 mt-2 mt-md-0">
                                        <?php
                                        $products_query = mysqli_query($connection, "SELECT * FROM products WHERE status = 1");
                                        $products_count = mysqli_num_rows($products_query);
                                        ?>
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Activated Products</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $products_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 mt-md-0">
                                        <?php
                                        $products_query = mysqli_query($connection, "SELECT * FROM products WHERE status = 0");
                                        $products_count = mysqli_num_rows($products_query);
                                        ?>
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Deactivated Products</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $products_count; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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