<?php
    session_start();
    if(!$_SESSION['login_user']){
        echo "<script>window.location.href = 'login.php'</script>";
    }
    require("connection.php");
?>
<?php require("top.php"); ?>
<title>Shopping Cart</title>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

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
                                            // $fetch_cart = mysqli_fetch_assoc($fetch_data_run);
                                            while ($fetch_assoc = mysqli_fetch_assoc($fetch_data_run)) {
                                                $product_query = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $fetch_assoc['product_id'] . "'");
                                                $pro_fetch = mysqli_fetch_assoc($product_query);
                                                echo "<tr>";
                                                echo "<td>";
                                                    echo "<div class='cart_table_td_items cart_image'>";
                                                        echo "<img src='../admin-panel/" . $pro_fetch['image'] . "' class='cart_img' alt='$pro_fetch[name] Image'>";
                                                    echo "</div>";
                                                echo "</td>";
                                                echo "<td>";
                                                    echo "<div class='cart_table_td_items cart_pro_name'>";
                                                        echo "<input type='hidden' name='p_id' value='$fetch_assoc[id]'/>";
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
                                                            echo "<input type='number' value='" . $fetch_assoc['product_qty'] . "' name='p_qty' >";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</td>";
                                                echo "<td>";
                                                    echo "<div class='cart_table_td_items cart_pro_total'>";
                                                        echo "<h5>Rs " . $pro_fetch['price'] * $fetch_assoc['product_qty'] . "/-</h5>";
                                                    echo "</div>";
                                                echo "</td>";
                                                echo "<td class='cart__close' ><button type='submit' name='remove_cart_item' value='$fetch_assoc[id]' class='btn' onclick='return cart_cross()' ><i class='fa fa-close'></i></button></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<div class='bg-danger text-white px-5 py-2 my-2'><h4>No items found in the cart.</h4></div>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php 
                                if(isset($_POST['remove_cart_item'])){
                                    $remove_query = "DELETE FROM cart WHERE id = $_POST[remove_cart_item]";
                                    $run_remove_query = mysqli_query($connection,$remove_query);
                                    if($run_remove_query){
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
                                    <button type="submit" class="btn btn-dark btn-lg " name="update_cart_btn" >Update cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['update_cart_btn'])){
                        //    continue on update cart and validate product qty
                        }
                    ?>
                </div>
            </div>
            <div class="row my-4 ">
                <div class="col-md-6">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Total <span>$ 169.50</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
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