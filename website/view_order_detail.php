<?php
require("connection.php");
session_start();
?>
<?php require("top.php"); ?>
<title>My-Orders</title>
<?php require("navbar.php"); ?>
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$fetch_query = "SELECT order_details.*,order_details.product_qty as 'pro_qty',user_order.*,user_order.id as 'o_id',products.*,products.name as 'p_name',products.id as 'p_id',users.* FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id INNER JOIN products ON order_details.product_id = products.id INNER JOIN users ON order_details.user_id = users.user_id WHERE order_details.user_id = $_SESSION[login_user] and order_details.order_id = $_GET[id]";
$fetch_order = mysqli_query($connection, $fetch_query);;
$fetch = mysqli_fetch_assoc($fetch_order);
?>
<section class="order_section null_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="order">
                    <table class="table table-bordered">
                        <thead>
                            <th>Order Id : #<?php echo $fetch['o_id'] ?></th>
                        </thead>
                        <tbody>
                            <tr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Qty</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="product_details.php?id=<?php echo $fetch['p_id'] ?>">
                                                    <img src="../admin-panel/<?php echo $fetch['image']; ?>" width="100px" alt="Image Goes Here" class="my-2">
                                                </a>
                                            </td>
                                            <td>
                                                <h5 class="my-2 font-weight-bold"><?php echo $fetch['name'] ?></h5>
                                            </td>
                                            <td>
                                                <h5 class="my-2 font-weight-bold"><?php echo $fetch['pro_qty'] ?></h5>
                                            </td>
                                            <td>
                                                <h5 class="my-2 font-weight-bold">Rs <?php echo $fetch['product_price'] ?>/-</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product p-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Shipping Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h5 class="my-2 ">Name: <?php echo $fetch['user_name'] ?>.</h5>
                                    <h5 class="my-2 ">Address: <?php echo $fetch['address'] ?>.</h5>
                                    <h5 class="my-2 ">Contact #: <?php echo $fetch['user_mobile'] ?>.</h5>
                                    <h5 class="my-2 ">Karachi.</h5>
                                    <h5 class="my-2 ">Pakistan.</h5>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="order_info d-flex align-items-center font-weight-bold justify-content-between">
                        <h4 class=" border-bottom border-dark"></h4>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Shipping Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    $class = "";
                                    if ($fetch['order_status'] == "cancelled") {
                                        $class = "border-danger text-danger";
                                    } elseif ($fetch['order_status'] == "shipped") {
                                        $class = "border-dark text-dark";
                                    } elseif ($fetch['order_status'] == "delivered") {
                                        $class = "border-success text-success";
                                    } else {
                                        $class = "border-warning text-warning";
                                    }
                                    ?>
                                    <h5 class="my-2 ">Order Status: <span class="border <?php echo $class; ?> px-2 py-1"><?php echo $fetch['order_status'] ?></span></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>