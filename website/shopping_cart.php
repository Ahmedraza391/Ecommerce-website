<?php
session_start();
if (!$_SESSION['login_user']) {
    echo "<script>window.location.href = 'login.php'</script>";
}
require("connection.php");
?>
<?php require("top.php"); ?>
<title>Shopping Cart</title>
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
<section class="shopping-cart my-5">
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST">
                    <div class="shopping__cart__table">
                        <table class="table cart_table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">
                                        <h5>ID</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Image</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Name</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Price</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Product Qty</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Total</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Remove</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fetch_data = "SELECT * FROM cart WHERE user_id = '" . $_SESSION['login_user'] . "'";
                                $fetch_data_run = mysqli_query($connection, $fetch_data);
                                $numrow = mysqli_num_rows($fetch_data_run);

                                if ($numrow > 0) {
                                    $inc = 1;
                                    while ($fetch_assoc = mysqli_fetch_assoc($fetch_data_run)) {
                                        $product_query = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $fetch_assoc['product_id'] . "'");
                                        $pro_fetch = mysqli_fetch_assoc($product_query);
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_image'>";
                                        echo $inc;
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<div class='cart_table_td_items cart_image'>";
                                        echo "<a href='product_details.php?id=$pro_fetch[id]'>";
                                        echo "<img src='../admin-panel/" . $pro_fetch['image'] . "' class='cart_img' alt='$pro_fetch[name] Image'>";
                                        echo "</a>";
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
                                        $inc++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='bg-info text-white px-5 py-2 my-2'><h5>No items found in the cart.</h5></td></tr>";
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
                            <div>
                                <a href="categories_products.php" class="btn btn-danger ">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <?php
                                $dis = "";
                                $if_user_dont_have_products = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = $_SESSION[login_user]");
                                if (mysqli_num_rows($if_user_dont_have_products) > 0) {
                                    // $dis = "disabled";
                                } else {
                                    $dis = "disabled";
                                }
                                ?>
                                <div>
                                    <button type="submit" <?php echo $dis; ?> class="btn btn-dark" name="update_cart_btn">Update cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['update_cart_btn'])) {
                    $result = "";
                    foreach ($_POST['p_qty'] as $index => $quantity) {
                        // Sanitize the input
                        $cart_item_id = mysqli_real_escape_string($connection, $_POST['p_id'][$index]);
                        $quantity = mysqli_real_escape_string($connection, $quantity);

                        // Update the cart with new quantity
                        $product_query = mysqli_query($connection, "SELECT * FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.id = $cart_item_id");
                        $pro_fetch = mysqli_fetch_assoc($product_query);
                        $selectProductQuantity = $pro_fetch['qty'];
                        if ($quantity == 0) {
                            echo "<script>alert('Minimum qty should be 1 or greater than 1')</script>";
                        } else {
                            if ($quantity <= $selectProductQuantity) {
                                $updateCart = "UPDATE cart SET product_qty='$quantity' WHERE id='$cart_item_id'";
                                $result = mysqli_query($connection, $updateCart);
                            } else {
                                echo "<script>alert('Limit Exceeded for " . $pro_fetch['name'] . "')</script>";
                            }
                        }
                    }
                    if ($result) {
                        echo "<script>alert('Cart Updated Successfully');window.location.href = 'shopping_cart.php'</script>";
                    }
                }
                ?>

            </div>
        </div>
        <div class="row my-4 ">
            <div class="col-md-1"></div>
            <div class="col-md-12">
                <div class="cart__total">
                    <?php
                    $fetch_cart  = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = $_SESSION[login_user] AND status = 1");
                    $pro_total = 0;
                    $sub = 0;
                    foreach ($fetch_cart as $cart) {
                        $fetch_product = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM products WHERE id = $cart[product_id]"));
                        $pro_total += $fetch_product['price'] * $cart['product_qty'];
                        $sub = $pro_total;
                    }
                    ?>
                    <form method="POST">
                        <h6>Cart total</h6>
                        <input type="text" placeholder="Sub Total" readonly value="Total : Rs <?php echo $sub; ?>/-">
                        <div class="button">
                            <button name="btn_checkout" class="btn btn-danger">Proceed to checkout</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['btn_checkout'])) {
                        $check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = $_SESSION[login_user]");
                        if (mysqli_num_rows($check_cart) > 0) {
                            echo "<script>window.location.href = 'checkout.php'</script>";
                        } else {
                            echo "<script>alert('You Dont Have Products In Cart');window.location.href = 'shopping_cart.php'</script>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>