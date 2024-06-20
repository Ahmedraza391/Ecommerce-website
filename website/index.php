<?php
session_start();
require("connection.php")
?>
<?php require("top.php") ?>
<title>Home /</title>
<?php
    $file_name = "home";

    $slider_status = true;
    $_fetch_products = "SELECT tbl_slider.*, products.* FROM tbl_slider INNER JOIN products ON tbl_slider.product_id = products.id WHERE products.status = 1 AND tbl_slider.status = 'show' ";
    $run_fetch = mysqli_query($connection, $_fetch_products);
?>
<div id="preloder">
    <div class="loader"></div>
</div>
<?php require("navbar.php") ?>
<section class="hero_container">
    <div id="carousel_caption" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            if ($run_fetch) {
                foreach ($run_fetch as $pro) {
                    $active = $slider_status ? 'active' : '';
                    echo "<div class='carousel-item $active'>";
                        echo "<a href='$pro[anchor_page]'>";
                            echo "<img src='../admin-panel/$pro[product_image]' class='d-block' alt='...'>";
                            echo "<div class='carousel-caption d-none d-md-block'>";
                                echo "<h5>$pro[name]</h5>";
                                echo "<p>$pro[product_desc]</p>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                    $slider_status = false;
                }
            } else {
                echo "Error fetching products: " . mysqli_error($connection);
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carousel_caption" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carousel_caption" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</section>
<section class="product_section">
    <div class="container">
        <div class="row m-0">
            <div class="product_heading">
                <h2>Top Selling Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="products">
                    <?php
                    $fetch_product = mysqli_query($connection, "SELECT products.*,categories.status as 'c_status',categories.id as 'c_id' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.status = 1 and categories.status = 1 LIMIT 4");
                    foreach ($fetch_product as $product) {
                        echo "<div class='product_card'>";
                        echo "<a href='product_details.php?id=$product[id]'>";
                        echo "<div class='product_image'>";
                        echo "<img src='../admin-panel/$product[image]' alt=''>";
                        echo "</div>";
                        echo "<div class='product_body'>";
                        echo "<h5>$product[name]</h5>";
                        echo "<h6>Rs $product[price]/-</h6>";
                        echo "<h6>Rs $product[mrp]/-</h6>";
                        if ($product['qty'] > 0) {
                            echo "<h6 class='text-success'>Instock</h6>";
                        } else {
                            echo "<h6 class='text-danger'>Out of Stock</h6>";
                        }
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="first_banner_product">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="banner_behind_product">
                                <h2>Explore Men's Shoes</h2>
                                <a href="categories_products.php?c_id=2" class="btn btn-outline-danger">Explore Shoes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product_section">
    <div class="container">
        <div class="row m-0">
            <div class="product_heading">
                <h2>Our Products</h2>
            </div>
        </div>
        <div class="products">
            <?php
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
                echo "<h6>Rs $product[mrp]/-</h6>";
                if ($product['qty'] > 0) {
                    echo "<h6 class='text-success'>Instock</h6>";
                } else {
                    echo "<h6 class='text-danger'>Out of Stock</h6>";
                }
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</section>
<?php require("footer.php") ?>
<?php require("bottom.php") ?>