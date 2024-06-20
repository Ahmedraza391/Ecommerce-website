<?php
session_start();
if(!$_SESSION['login_user']){
    echo "<script>window.location.href = 'login.php'</script>";
}
require("connection.php");

?>
<?php require("top.php"); ?>
<title>Checkout - Your Order</title>
<div id="preloder">
    <div class="loader"></div>
</div>
<?php require("navbar.php") ?>
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout my-5 ">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <h6 class="checkout__title">Billing Details</h6>
                    <?php
                        $fetch_info_query = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $_SESSION[login_user]");
                        $fetch_info = mysqli_fetch_assoc($fetch_info_query);
                    ?>
                    <form method="POST">
                        <div class="checkout__input">
                            <p>Full Name<span>*</span></p>
                            <input type="text" placeholder="Enter Your Full Name" name="user_fname" value="<?php echo htmlspecialchars($fetch_info['user_name'], ENT_QUOTES); ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Phone<span>*</span></p>
                            <input type="number" placeholder="Enter Mobile No" name="user_mobile" value="<?php echo htmlspecialchars($fetch_info['user_mobile'], ENT_QUOTES); ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="email" placeholder="Enter Your Email" value="<?php echo htmlspecialchars($fetch_info['user_email'], ENT_QUOTES); ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Address <span> 1</span></p>
                            <input type="text" name="user_address" placeholder="Enter Your Address"  value="<?php echo htmlspecialchars($fetch_info['user_address_1'], ENT_QUOTES); ?>"required >
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" readonly name="user_city" value="<?php echo $fetch_info['user_city'] ?>" >
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input type="text" readonly name="user_country" value="<?php echo $fetch_info['user_country'] ?>" >
                        </div>
                        <div class="update_btn">
                            <button type="submit" class="btn btn-danger" name="btn_update">Update Info</button>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['btn_update'])){
                            $user_name = $_POST['user_fname'];
                            $user_mobile = $_POST['user_mobile'];
                            $user_email = $_POST['user_email'];
                            $user_address = $_POST['user_address'];
                            $user_id = $_SESSION['login_user'];
                            $update_query = "UPDATE users SET user_name = '$user_name', user_email = '$user_email', user_mobile = '$user_mobile', user_address_1 = '$user_address' WHERE user_id = $user_id";
                            if(mysqli_query($connection,$update_query)){
                                ?><script>alert('Information Updated');window.location.href = "checkout.php" </script><?php
                            }
                        }
                    ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4 class="order__title">Your order</h4> 
                        <form method="POST">
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                $fetch_cart_query = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = $_SESSION[login_user] AND status = 1");
                                $sub_total = 0;
                                $dis = "";
                                if(mysqli_num_rows($fetch_cart_query)>0){
                                    foreach ($fetch_cart_query as $cart_item) {
                                        $fetch_cart_product = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM products WHERE id = $cart_item[product_id]"));
                                        echo "<li>";
                                        echo "<div class='checkout__total__products__div'>";
                                        echo "<img src='../admin-panel/" . $fetch_cart_product["image"] . "' width='50px' height='50px' />";
                                        echo "<h5 class='checkout_product_total'>" . $fetch_cart_product["name"] . "</h5>";
                                        echo "<h6 class='checkout_product_qty'>    x  $cart_item[product_qty] = </h6>";
                                        echo "<h6 class='checkout_product_price'> Rs " . $cart_item['product_qty'] * $fetch_cart_product['price'] . "/- </h6>";
                                        echo "</div>";
                                        echo "</li>";
                                        $sub_total += $cart_item['product_qty'] * $fetch_cart_product['price'];
                                    }
                                }else{
                                    echo "<h6 class='text-danger'>You Dont Have Products</h6>";
                                    $dis = "disabled";
                                }
                                ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span><?php echo "Rs " . $sub_total . "/-"; ?></span></li>
                                <li>Total <span><?php echo "Rs " . $sub_total . "/-"; ?><input type="hidden" name="total" value="<?php echo $sub_total; ?>"></span></li>
                            </ul>
                            <div class="payment_method">
                                <select name="payment_method" id="" class="w-100" <?php echo $dis; ?> required>
                                    <option hidden value="">Select Payment Method</option>
                                    <option value="easypaisa">EasyPaisa</option>
                                    <option value="jazzcash">Jazzcash</option>
                                    <option value="cod">Cash on Delivery</option>
                                </select>
                            </div>
                            <button type="submit" class="site-btn" name='order_btn' <?php echo $dis; ?> >PLACE ORDER</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php 
                if (isset($_POST['order_btn'])) {
                    $user_id = $_SESSION['login_user'];
                    $user_mobile = $fetch_info['user_mobile'];
                    $user_address = $fetch_info['user_address_1'];
                    $total = $_POST['total'];
                    $payment = $_POST['payment_method'];
                    $payment_status = ($payment == "cod") ? "success" : "pending"; // Adjust as needed
                    $date = date('Y-m-d H:i:s');
                    if (!empty($user_mobile) && !empty($user_address) && !empty($total) && !empty($payment)) {
                
                        $insert_order_query = "INSERT INTO user_order (user_id, user_mobile, address, payment_type, payment_status, total_price, added_on) VALUES ('$user_id', '$user_mobile', '$user_address', '$payment', '$payment_status', '$total', '$date')";
                
                        if (mysqli_query($connection, $insert_order_query)) {
                            $order_id = mysqli_insert_id($connection);
                
                            foreach ($fetch_cart_query as $cart_item) {
                                $product_id = $cart_item['product_id'];
                                $product_qty = $cart_item['product_qty'];
                                $fetch_cart_product = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM products WHERE id = $product_id"));
                                $product_price = $fetch_cart_product['price'];
                
                                $insert_order_details_query = "INSERT INTO order_details (order_id, user_id, product_id, product_qty, product_price) VALUES ('$order_id', '$user_id', '$product_id', '$product_qty', '$product_price')";
                
                                if (mysqli_query($connection, $insert_order_details_query)) {
                                    $available_qty = $fetch_cart_product['qty'] - $product_qty;
                                    $update_product_table_query = "UPDATE products SET qty = $available_qty WHERE id = $product_id";
                                    
                                    if (mysqli_query($connection, $update_product_table_query)) {
                                        $empty_cart_query = "DELETE FROM cart WHERE user_id = $_SESSION[login_user]";
                                        if(mysqli_query($connection, $empty_cart_query)){
                                            $order_notification_query = mysqli_query($connection,"INSERT INTO order_notification (order_id)VALUES($order_id)");
                                        }
                                    }
                                }
                            }
                
                            echo "<script>
                                    alert('Order Placed Successfully');
                                    window.location.href = 'thankyou.php';
                                  </script>";
                        } else {
                            echo "<script>alert('Failed to place order');</script>";
                        }
                    } else {
                        echo "<script>alert('Please fill in all required fields');</script>";
                    }
                }
                
            ?>
        </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>