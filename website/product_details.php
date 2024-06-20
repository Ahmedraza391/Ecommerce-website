<?php
    session_start();
    require("connection.php");
?>
<?php require("top.php"); ?>
    <title>Product Details</title>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php require("navbar.php"); ?>

    <?php
        $query = mysqli_query($connection,"SELECT * FROM products WHERE id = $_GET[id]");
        $fetch = mysqli_fetch_assoc($query);
    ?>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="index.php">Home</a>
                            <a href="categories_products.php">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="..//admin-panel//<?php echo $fetch['image']?>">
                                    </div>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-2.png">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-3.png">
                                    </div>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="../admin-panel/<?php echo $fetch['image']?>" alt="">
                                </div>
                            </div>
                            <!-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="img/shop-details/product-big-3.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="img/shop-details/product-big.png" alt="">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?php echo $fetch['name'] ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>Rs <?php echo $fetch['price'] ?>/-<span>Rs <?php echo $fetch['mrp'] ?>/-</span></h3>
                            <p><?php echo $fetch['short_desc'] ?></p>
                            <?php
                                $qty =$fetch['qty'];
                                if($qty > 0){
                                    echo "<div class='instoc my-2'>";
                                        echo "<span>InStock $fetch[qty]  $fetch[name] left.</span>";
                                    echo "</div>";
                                }else{
                                    echo "<div class='instoc my-2'>";
                                        echo "<span>Out of Stock $fetch[name].</span>";
                                    echo "</div>";
                                }
                            ?>
                            <!-- <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" id="xxl">
                                    </label>
                                    <label class="active" for="xl">xl
                                        <input type="radio" id="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" id="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" id="sm">
                                    </label>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    <label class="c-1" for="sp-1">
                                        <input type="radio" id="sp-1">
                                    </label>
                                    <label class="c-2" for="sp-2">
                                        <input type="radio" id="sp-2">
                                    </label>
                                    <label class="c-3" for="sp-3">
                                        <input type="radio" id="sp-3">
                                    </label>
                                    <label class="c-4" for="sp-4">
                                        <input type="radio" id="sp-4">
                                    </label>
                                    <label class="c-9" for="sp-9">
                                        <input type="radio" id="sp-9">
                                    </label>
                                </div>
                            </div> -->
                            <div class="product__details__cart__option">
                                <form method="POST">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="qty">
                                        </div>
                                    </div>
                                    <button type="submit" name="cart_btn" class="primary-btn">add to cart</button>
                                </form>
                                <?php
                                    if(isset($_POST['cart_btn'])){
                                        if($_SESSION['login_user']){
                                            $qty_query = mysqli_query($connection,"SELECT * FROM products WHERE id = $_GET[id]");
                                            $fetch_qty = mysqli_fetch_assoc($qty_query);
                                            $qty = $_POST['qty'];
                                            if($qty > $fetch_qty['qty']){
                                                if($fetch_qty['qty']<=0 ){
                                                    echo "<script>alert('$fetch_qty[name] out of stock')</script>";
                                                }else{
                                                    echo "<script>alert('$fetch_qty[qty] $fetch_qty[name] left')</script>";
                                                }
                                            }else if($qty <= 0){
                                                echo "<script>alert('Minimum Qty should be 1 or Greater than 1')</script>";
                                            }else{
                                                $user_id = $_SESSION['login_user'];
                                                $product_id = $fetch_qty['id'];
                                                $product_qty = $_POST['qty'];
                                                $if_product_exists = mysqli_query($connection,"SELECT * FROM cart WHERE product_id = $product_id and user_id = $_SESSION[login_user]");
                                                $exist_count = mysqli_num_rows($if_product_exists);
                                                if($exist_count > 0){
                                                    echo "<script>alert('Product Already Exists')</script>";
                                                }else{
                                                    $insert_query = mysqli_query($connection,"INSERT INTO cart (user_id,product_id,product_qty,status)VALUES($user_id,$product_id,$product_qty,1)");
                                                    if($insert_query){
                                                        echo "<script>alert('Product Add Successfully in the cart')</script>";
                                                    }
                                                    echo "<script>window.location.href = 'shopping_cart.php'</script>";
                                                }
                                            }
                                        }else{
                                            echo "<script>window.location.href = 'login.php'</script>";
                                        }
                                    }
                                ?>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Product Description</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                                </li> -->
                            </ul>
                            <div class="tab-content my-3 ">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note"></p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p><?php echo $fetch['short_desc'] ?></p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Description</h5>
                                            <p><?php echo $fetch['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <?php require("footer.php"); ?>
<?php require("bottom.php"); ?>