<?php

use function PHPSTORM_META\map;
require("top.php") ?>
<title>Products /</title>
<?php
$file_name = "products"
?>
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

<!-- Shop Section Begin -->
<section class="categories_sec spad">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading d-flex justify-content-between " data-toggle="collapse" data-target="#collapseOne">
                                    <a>Select Categories</a><i class="fas fa-sort-down"></i>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <div class="filter_inputs">
                                                <form method="post">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="radio" name="categories" value="all" id="cate" required>
                                                            </div>
                                                        </div>
                                                        <label for="cate" class="form-control">All</label>
                                                    </div>
                                                    <?php
                                                    $fetch_query = mysqli_query($connection, "SELECT * FROM categories WHERE status = 1");
                                                    foreach ($fetch_query as $category) {
                                                        echo "<div class='input-group mb-3'>";
                                                        echo "<div class='input-group-prepend'>";
                                                        echo "<div class='input-group-text'>";
                                                        echo "<input type='radio' id='$category[id]' name='categories' value='$category[id]' required>";
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "<label for='$category[id]' class='form-control'>$category[categories]</label>";
                                                        echo "</div>";
                                                    }
                                                    ?>
                                                    <button type="submit" name="btn_filter" class="btn btn-success my-2  ">Apply</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-6">
                <div class="shop__sidebar__search">
                    <form action="#">
                        <input type="text" id="search" placeholder="Search...">
                        <button type="submit"><span class="icon_search"></span></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select name="sort" id="sort_select">
                                    <option hidden>Select</option>
                                    <option value="low-high">Low To High</option>
                                    <option value="high-low">High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="products">
                    <?php
                    if (isset($_GET['c_id'])) {
                        $cid = $_GET['c_id'];
                        $check_query = mysqli_query($connection, "SELECT * FROM categories WHERE id = $cid");
                        $fetch = mysqli_fetch_assoc($check_query);
                        if ($cid !== $fetch['id']) {
                            echo "<script>window.location.href = 'categories_products.php'</script>";
                        } else {
                            if ($cid > 0) {
                                $value = true;
                                // this is for filter categories
                                if (isset($_POST['btn_filter'])) {
                                    $value = false;
                                    if ($value == false) {
                                        $category = $_POST['categories'];
                                        if ($category == "all") {
                                            $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1");
                                            foreach ($fetch_product as $product) {
                                                echo "<div class='product_card'>";
                                                    echo "<div>";
                                                        echo "<a href='product_details.php?id=$product[id]'>";
                                                            echo "<div class='product_image'>";
                                                                echo "<img src='../admin-panel/$product[image]' alt=''>";
                                                            echo "</div>";
                                                            echo "<div class='product_body'>";
                                                                echo "<h5>$product[name]</h5>";
                                                                echo "<h6>Rs $product[price]/-</h6>";
                                                                echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                                if ($product['qty'] > 0) {
                                                                    echo "<h6 class='text-success'>Instock</h6>";
                                                                } else {
                                                                    echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                                }
                                                            echo "</div>";
                                                        echo "</a>";
                                                    echo "</div>";
                                                echo "</div>";
                                            }
                                        } else {
                                            $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE categories_id = $category and status = 1");
                                            foreach ($fetch_product as $product) {
                                                echo "<div class='product_card'>";
                                                echo "<a href='product_details.php?id=$product[id]' class='product_hover product_hover_1'> View Product</a>";
                                                echo "<a href='shopping_cart.php?id=$product[id]' class='product_hover product_hover_2'> + Add to Cart</a>";
                                                echo "<div>";
                                                echo "<div class='product_image'>";
                                                echo "<img src='../admin-panel/$product[image]' alt=''>";
                                                echo "</div>";
                                                echo "<div class='product_body'>";
                                                echo "<h5>$product[name]</h5>";
                                                echo "<h6>Rs $product[price]/-</h6>";
                                                echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                if ($product['qty'] > 0) {
                                                    echo "<h6 class='text-success'>Instock</h6>";
                                                } else {
                                                    echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                }
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                            }
                                        }
                                    }
                                }
                                // this is for by default products when the page load
                                if ($value == true) {
                                    $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1 AND categories_id = $cid");
                                    foreach ($fetch_product as $product) {
                                        echo "<div class='product_card'>";
                                            echo "<div>";
                                                echo "<a href='product_details.php?id=$product[id]'>";
                                                    echo "<div class='product_image'>";
                                                        echo "<img src='../admin-panel/$product[image]' alt=''>";
                                                    echo "</div>";
                                                    echo "<div class='product_body'>";
                                                        echo "<h5>$product[name]</h5>";
                                                        echo "<h6>Rs $product[price]/-</h6>";
                                                        echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                        if ($product['qty'] > 0) {
                                                            echo "<h6 class='text-success'>Instock</h6>";
                                                        } else {
                                                            echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                        }
                                                    echo "</div>";
                                                echo "</a>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "<script>window.location.href = 'categories_products.php';</script>";
                            }
                        }
                    } else {
                        $value = true;
                        // this is for filter categories
                        if (isset($_POST['btn_filter'])) {
                            $value = false;
                            if ($value == false) {
                                $category = $_POST['categories'];
                                if ($category == "all") {
                                    $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1");
                                    foreach ($fetch_product as $product) {
                                        echo "<div class='product_card'>";
                                            echo "<div>";
                                                echo "<a href='product_details.php?id=$product[id]'>";
                                                    echo "<div class='product_image'>";
                                                        echo "<img src='../admin-panel/$product[image]' alt=''>";
                                                    echo "</div>";
                                                    echo "<div class='product_body'>";
                                                        echo "<h5>$product[name]</h5>";
                                                        echo "<h6>Rs $product[price]/-</h6>";
                                                        echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                        if ($product['qty'] > 0) {
                                                            echo "<h6 class='text-success'>Instock</h6>";
                                                        } else {
                                                            echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                        }
                                                    echo "</div>";
                                                echo "</a>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                } else {
                                    $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE categories_id = $category and status = 1");
                                    foreach ($fetch_product as $product) {
                                        echo "<div class='product_card'>";
                                            echo "<div>";
                                                echo "<a href='product_details.php?id=$product[id]'>";
                                                    echo "<div class='product_image'>";
                                                        echo "<img src='../admin-panel/$product[image]' alt=''>";
                                                    echo "</div>";
                                                    echo "<div class='product_body'>";
                                                        echo "<h5>$product[name]</h5>";
                                                        echo "<h6>Rs $product[price]/-</h6>";
                                                        echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                        if ($product['qty'] > 0) {
                                                            echo "<h6 class='text-success'>Instock</h6>";
                                                        } else {
                                                            echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                        }
                                                    echo "</div>";
                                                echo "</a>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            } else {
                            }
                        } else {
                        }
                        // this condition is for by default product when the page load
                        if ($value == true) {
                            $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1");
                            foreach ($fetch_product as $product) {
                                echo "<div class='product_card'>";
                                    echo "<div>";
                                        echo "<a href='product_details.php?id=$product[id]'>";
                                            echo "<div class='product_image'>";
                                                echo "<img src='../admin-panel/$product[image]' alt=''>";
                                            echo "</div>";
                                            echo "<div class='product_body'>";
                                                echo "<h5>$product[name]</h5>";
                                                echo "<h6>Rs $product[price]/-</h6>";
                                                echo "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                                                if ($product['qty'] > 0) {
                                                    echo "<h6 class='text-success'>Instock</h6>";
                                                } else {
                                                    echo "<h6 class='text-danger'>Out of Stock</h6>";
                                                }
                                            echo "</div>";
                                        echo "</a>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>