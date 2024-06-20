<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
?>
<?php include("top_page.php") ?>
<?php include("sidebar.php"); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column  m-0">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="container most_margin">
            <div class="row m-0">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="container bg-light shadow p-md-5 mb-5 bg-light rounded">
                        <div class="row">
                            <?php
                            $fetch = mysqli_query($connection, "SELECT order_details.*,order_details.id as 'o_id',user_order.*,users.user_name as 'u_name',users.user_email as 'u_email',products.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id INNER JOIN users ON order_details.user_id = users.user_id INNER JOIN products ON order_details.product_id = products.id WHERE order_details.order_id = $_GET[id]");
                            $order = mysqli_fetch_assoc($fetch);
                            ?>
                            <div class="col-md-12">
                                <div class="heading card text-center text-dark p-2">
                                    <h2> Order Details</h2>
                                </div>
                                <!-- continue on this -->
                                <div class="card p-3">
                                    <div class="order_id">
                                        <h5 class="font-weight-bold text-primary m-0">Order ID : </h5>
                                        <h6 class="ml-3 font-weight-bold ">#<?php echo $order['o_id']; ?></h6>
                                    </div>
                                    <div class="order_customer_name">
                                        <h5 class="font-weight-bold text-primary">Customer Name : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $order['u_name']; ?></h6>
                                    </div>
                                    <div class="order_customer_email">
                                        <h5 class="font-weight-bold text-primary">Customer Email : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $order['u_email']; ?></h6>
                                    </div>
                                    <div class="order_customer_mobile">
                                        <h5 class="font-weight-bold text-primary">Customer Mobile No : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $order['user_mobile']; ?></h6>
                                    </div>
                                    <div class="order_customer_address">
                                        <h5 class="font-weight-bold text-primary">Customer Address : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $order['address']; ?></p>
                                    </div>
                                    <div class="order_product_name">
                                        <h5 class="font-weight-bold text-primary">Order Product Name : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $order['name']; ?></p>
                                    </div>
                                    <div class="order_product_price">
                                        <h5 class="font-weight-bold text-primary">Order Product Price : </h5>
                                        <p class="ml-3 font-weight-bold ">Rs <?php echo $order['product_price']; ?>/-</p>
                                    </div>
                                    <div class="order_product_qty">
                                        <h5 class="font-weight-bold text-primary">Order Product Qty : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $order['product_qty']; ?></p>
                                    </div>
                                    <div class="order_status">
                                        <h5 class="font-weight-bold text-primary">Order Product Qty : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $order['order_status']; ?></p>
                                    </div>
                                    <div class="date">
                                        <h5 class="font-weight-bold text-primary">Date / Time : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $order['added_on']; ?></h6>
                                    </div>
                                </div>
                                <div class="button my-2">
                                    <?php
                                    $url = "";
                                    if ($_GET['message'] == "notification") {
                                        $url = "order_notification.php?message=update_contact";
                                    } else {
                                        $url = "order.php";
                                    }
                                    ?>
                                    <button class="btn btn-primary"><a href="<?php echo $url; ?>" class="text-decoration-none text-white">Back</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php") ?>