<?php
require("connection.php");
session_start();
?>
<?php require("top.php"); ?>
<title>My-Orders</title>
<?php require("navbar.php"); ?>
<div id="preloder">
    <div class="loader"></div>
</div>
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
<section class="order_section null_sec">
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST">
                    <div class="shopping__cart__table">
                        <table class="table cart_table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">
                                        <h5>Order ID</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Image</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Name</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Order Status</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Order Detials</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fetch_query = "SELECT order_details.*,products.*,user_order.* FROM order_details INNER JOIN products ON order_details.product_id = products.id INNER JOIN user_order ON order_details.order_id = user_order.id WHERE order_details.user_id = $_SESSION[login_user]";
                                $run_fetch_query = mysqli_query($connection, $fetch_query);
                                foreach ($run_fetch_query as $order) {
                                    echo "<tr>";
                                    echo "<td>$order[order_id]</td>";
                                    echo "<td><img src='../admin-panel/$order[image]' width='60px' height='60px'></td>";
                                    echo "<td><h5>$order[name]</h5></td>";
                                    echo "<td><h5>$order[order_status]</h5></td>";
                                    echo "<td><a href='view_order_detail.php?id=$order[order_id]' class='btn btn-success text-white'><h5>Check Details</h5></a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php

                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>