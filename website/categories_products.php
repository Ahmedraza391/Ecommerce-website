<?php
require("top.php");
require("connection.php");
session_start();
$file_name = "products"
?>
<title>Products /</title>
<?php require("navbar.php") ?>
<div id="preloder">
    <div class="loader"></div>
</div>
<section class="categories_sec spad">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-11 my-3 mx-auto  col-lg-6">
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
            <div class="col-sm-12 col-md-11  mx-auto  col-lg-6">
                <div class="shop__sidebar__search">
                    <form id="search_form">
                        <input type="text" id="search_input" placeholder="Search Products..">
                        <button type="button" id="btn_search" name="btn_search"><span class="icon_search"></span></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="shop__product__option">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <hr>
                    <div class="shop__product__option__right">
                        <p class="mx-3">Sort by Price:</p>
                        <form>
                            <select name="sort" id="sort_select">
                                <option hidden>Select</option>
                                <option value="l_high">Low To High</option>
                                <option value="h_low">High To Low</option>
                            </select>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="products" id="searched_products"></div>
                        <div class="products" id="products">
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
                                                    $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 and categories.status = 1");
                                                    foreach ($fetch_product as $product) {
                                                        echo "<div class='product_card'>";
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
                                                    }
                                                } else {
                                                    $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.categories_id = $category and products.status = 1 and categories.status = 1");
                                                    foreach ($fetch_product as $product) {
                                                        echo "<div class='product_card'>";
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
                                                    }
                                                }
                                            }
                                        }
                                        // this is for by default products when the page load
                                        if ($value == true) {
                                            $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.categories_id = $cid and products.status = 1 and categories.status = 1");
                                            foreach ($fetch_product as $product) {
                                                echo "<div class='product_card'>";
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
                                            $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 and categories.status = 1");
                                            foreach ($fetch_product as $product) {
                                                echo "<div class='product_card'>";
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
                                            }
                                        } else {
                                            $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.categories_id = $category and products.status = 1 and categories.status = 1");
                                            foreach ($fetch_product as $product) {
                                                echo "<div class='product_card'>";
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
                                            }
                                        }
                                    } else {
                                    }
                                } else {
                                }
                                // this condition is for by default product when the page load
                                if ($value == true) {
                                    $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 and categories.status = 1");
                                    foreach ($fetch_product as $product) {
                                        echo "<div class='product_card'>";
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
        </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>