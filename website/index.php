<?php
    session_start();
    require("connection.php")
?>
<?php
// if(isset())
?>
<?php require("top.php") ?>
<title>Home /</title>
<?php
$file_name = "home"
?>
<?php require("navbar.php") ?>
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, itaque.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2030</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2030</h2>
                        <a href="#">Shop now</a>
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
                <h2>Top Selling Products</h2>
            </div>
        </div>
        <div class="products">
            <?php
                $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1 LIMIT 4");
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
                                    echo "<h6>Rs $product[mrp]/-</h6>";
                                    if($product['qty']>0){
                                        echo "<h6 class='text-success'>Instock</h6>";
                                    }else{
                                        echo "<h6 class='text-danger'>Out of Stock</h6>";
                                    }
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</section>
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="img/product-sale.png" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
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
                $fetch_product = mysqli_query($connection, "SELECT * FROM products WHERE status = 1");
                foreach ($fetch_product as $product) {
                    echo "<div class='product_card'>";
                        echo "<div>";
                            echo"<a href='product_details.php?id=$product[id]'>";
                                echo "<div class='product_image'>";
                                    echo "<img src='../admin-panel/$product[image]' alt=''>";
                                echo "</div>";
                                echo "<div class='product_body'>";
                                    echo "<h5>$product[name]</h5>";
                                    echo "<h6>Rs $product[price]/-</h6>";
                                    echo "<h6>Rs $product[mrp]/-</h6>";
                                    if($product['qty']>0){
                                        echo "<h6 class='text-success'>Instock</h6>";
                                    }else{
                                        echo "<h6 class='text-danger'>Out of Stock</h6>";
                                    }
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</section>
<?php require("footer.php") ?>
<?php require("bottom.php") ?>