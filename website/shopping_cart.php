<?php
    session_start();
    if(!$_SESSION['login_user']){
        echo "<script>window.location.href = 'login.php'</script>";
    }
    require("connection.php");
?>
<?php require("top.php"); ?>
<title>Shopping Cart</title>
    <?php require("navbar.php"); ?>

    <!-- Breadcrumb Section Begin -->
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
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart my-5">
        <div class="container">
            <div class="row my-2">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST">
                    <div class="shopping__cart__table">
                        <table class="table cart_table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><h5>Cart Id</h5></th>
                                    <th scope="col"><h5>Product Image</h5></th>
                                    <th scope="col"><h5>Product Name</h5></th>
                                    <th scope="col"><h5>Product Price</h5></th>
                                    <th scope="col"><h5>Product Qty</h5></th>
                                    <th scope="col"><h5>Total</h5></th>
                                    <th scope="col"><h5>Remove</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fetch_data = "SELECT * FROM cart WHERE user_id = '" . $_SESSION['login_user'] . "'";
                                $fetch_data_run = mysqli_query($connection, $fetch_data);
                                $numrow = mysqli_num_rows($fetch_data_run);

                                if ($numrow > 0) {
                                    while ($fetch_assoc = mysqli_fetch_assoc($fetch_data_run)) {
                                        $product_query = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $fetch_assoc['product_id'] . "'");
                                        $pro_fetch = mysqli_fetch_assoc($product_query);
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_image'>";
                                        echo $fetch_assoc['id'];
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_image'>";
                                        echo "<img src='../admin-panel/" . $pro_fetch['image'] . "' class='cart_img' alt='$pro_fetch[name] Image'>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_pro_name'>";
                                        echo "<input type='hidden' name='p_id[]' value='" . $fetch_assoc['id'] . "'/>";
                                        echo "<h5>" . $pro_fetch['name'] . "</h5>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_pro_price'>";
                                        echo "<h5>Rs " . $pro_fetch['price'] . "/-</h5>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='quantity__item'>";
                                        echo "<div class='quantity'>";
                                        echo "<div class='pro-qty-2'>";
                                        echo "<input type='number' value='" . $fetch_assoc['product_qty'] . "' name='p_qty[]' >";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_pro_total'>";
                                        echo "<h5>Rs " . $pro_fetch['price'] * $fetch_assoc['product_qty'] . "/-</h5>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='cart__close' ><button type='submit' name='remove_cart_item' value='" . $fetch_assoc['id'] . "' class='btn' onclick='return cart_cross()' ><i class='fa fa-close'></i></button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='bg-danger text-white px-5 py-2 my-2'><h4>No items found in the cart.</h4></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        if (isset($_POST['remove_cart_item'])) {
                            $remove_query = "DELETE FROM cart WHERE id = " . $_POST['remove_cart_item'];
                            $run_remove_query = mysqli_query($connection, $remove_query);
                            if ($run_remove_query) {
                                echo "<script>alert('Item Remove Successfully');window.location.href='shopping_cart.php'</script>";
                            }
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="categories_products.php">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <button type="submit" class="btn btn-dark btn-lg " name="update_cart_btn">Update cart</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['update_cart_btn'])) {
                    foreach ($_POST['p_qty'] as $index => $quantity) {
                        // Sanitize the input
                        $cart_item_id = mysqli_real_escape_string($connection, $_POST['p_id'][$index]);
                        $quantity = mysqli_real_escape_string($connection, $quantity);

                        // Update the cart with new quantity
                        $product_query = mysqli_query($connection, "SELECT * FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.id = $cart_item_id");
                        $pro_fetch = mysqli_fetch_assoc($product_query);
                        $selectProductQuantity = $pro_fetch['qty'];
                        if($quantity == 0){
                            echo "<script>alert('Minimum qty should be 1 or greater than 1')</script>";
                        }else{
                            if ($quantity <= $selectProductQuantity) {
                                $updateCart = "UPDATE cart SET product_qty='$quantity' WHERE id='$cart_item_id'";
                                mysqli_query($connection, $updateCart);
                            } else {
                                echo "<script>alert('Limit Exceeded for " . $pro_fetch['name'] . "')</script>";
                            }
                        }
                    }
                }
                ?>

                </div>
            </div>
            <div class="row my-4 ">
                <!-- <div class="col-md-6">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                </div> -->
                <div class="col-md-1"></div>
                <div class="col-sm-12 col-md-10 col-lg-10">
                    <div class="cart__total">
                        <?php
                            $fetch_cart  = mysqli_query($connection,"SELECT * FROM cart WHERE user_id = $_SESSION[login_user]");
                            $pro_total = 0;
                            foreach($fetch_cart as $cart){
                                $fetch_product = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM products WHERE id = $cart[product_id]"));
                                $pro_total += $fetch_product['price'] * $cart['product_qty'];
                                $sub = $pro_total;
                            }
                        ?>
                        <form method="POST">
                            <h6>Cart total</h6>
                            <input type="text" placeholder="Sub Total" readonly value="Total : Rs <?php echo $sub; ?>/-" >
                            <div class="button">
                                <button name="btn_checkout" class="primary-btn">Proceed to checkout</button>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['btn_checkout'])){

                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <?php require("footer.php"); ?>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    <script>
        function cart_cross(){
            return confirm("Are you sure you want to remove this item from cart")
        }
    </script>
<?php require("bottom.php"); ?>