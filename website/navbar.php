<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__nav__option">
        <ul class="mobile_links list-unstyled ">
            <li>
                <a href="shopping_cart.php">Cart <i class='fas fa-shopping-cart ml-2 my-2'></i><span>0</span></a>
            </li>
            <?php
                if(isset($_SESSION['login_user'])){
                    echo "<li><a href='user_profile.php'>Profile <i class='fas fa-user fw-lighter ml-2 my-2'></i></a></li>";
                    echo "<li><a href='logout_profile.php'>Logout <i class='fas fa-sign-out-alt fw-lighter ml-2 my-2'></i></a></li>";
                }else{
                    echo "<li><a href='login.php'>Login</a></li>";
                    echo "<li><a href='Register.php'>Register</a></li>";
                }
            ?>
        </ul>
    </div>
</div>
<!-- Offcanvas Menu End -->
<header class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="index.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="<?php if ($file_name == "home") {
                                        echo "active";
                                    } ?>"><a href="index.php">Home</a></li>
                        <li class="<?php if ($file_name == "products") {
                                        echo "active";
                                    } ?>"><a href="categories_products.php">Products</a></li>
                        <li class="<?php if ($file_name == "categories") {
                                        echo "active";
                                    } ?>"><a>Categories</a>
                            <ul class="dropdown">
                                <?php
                                require("connection.php");
                                $query = mysqli_query($connection, "SELECT * FROM categories WHERE status = 1");
                                foreach ($query as $data) {
                                    echo "<li>";
                                    echo "<a href='categories_products.php?c_id=$data[id]'>";
                                    echo $data["categories"];
                                    echo "</a>";
                                    echo "</li>";
                                }
                                ?>
                                <hr class="border border-danger m-0 d-md-none">
                                <li><a href="shop-details.php">Shop Details</a></li>
                                <li><a href="shopping_cart.php">Shopping Cart</a></li>
                                <li><a href="checkout.php">Check Out</a></li>
                            </ul>
                        </li>
                        <li class="<?php if ($file_name == "about_us") {
                                        echo "active";
                                    } ?>"><a href="about.php">About Us</a></li>
                        <li class="<?php if ($file_name == "contact_us") {
                                        echo "active";
                            } ?>"><a href="contact.php">Contacts</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="categories_products.php" id="search_product" class="search-switch"><img src="img/icon/search.png" alt="" title="Search Products"></a>
                    <?php 
                        if(isset($_SESSION['login_user'])){
                            $fetch_cart_count = mysqli_query($connection,"SELECT * FROM cart WHERE user_id = $_SESSION[login_user]");
                            if(mysqli_num_rows($fetch_cart_count)>0){
                                $count = mysqli_num_rows($fetch_cart_count);
                            }else{
                                $count = 0;
                            }
                        }else{
                            $count = 0;
                        }
                    ?>
                    <a href="shopping_cart.php" title="Shopping Cart"><img src="img/icon/cart.png" alt=""><span class="font-weight-bold text-danger "><?php echo $count; ?></span></a>
                    <div class="profile_menu">
                        <div title="Profile" class="menu_toggler">
                            <?php 
                                if(isset($_SESSION['login_user'])){
                                    $user_id = $_SESSION['login_user'];
                                    $fetch_user = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $user_id");
                                    $fetch_user_assoc = mysqli_fetch_assoc($fetch_user);
                                    $fetch_user_name = $fetch_user_assoc['user_name'];
                                    $first_character = substr($fetch_user_name, 0, 1);
                                    echo "<div class='user_dropdown'><h5>$first_character</h5></div>";
                                }else{
                                    echo "<i class='far fa-user'></i>";
                                }
                            ?>
                            <i class="fas fa-sort-down"></i>
                        </div>
                        <ul class="profile_dropdown">
                            <?php
                                if(isset($_SESSION['login_user'])){
                                    $user_id = $_SESSION['login_user'];
                                    $fetch_user = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $user_id");
                                    $fetch_user_assoc = mysqli_fetch_assoc($fetch_user);
                                    $fetch_user_name = $fetch_user_assoc['user_name'];
                                    $first_character = substr($fetch_user_name, 0, 1);
                                    echo "<script>console.log($first_character)</script>";
                                    echo "<li>
                                        <a href='user_profile.php'><b>Profile</b><i class='fas fa-user'></i></a>
                                    </li>";
                                    echo "<li>
                                        <a href='logout_profile.php'><b>Logout</b><i class='fas fa-sign-out-alt'></i></a>
                                    </li>";
                                }else{
                                    echo "<li>
                                        <a href='login.php'><b>Login</b></a>
                                    </li>";
                                    echo "<li>
                                        <a href='register.php'><b>Singup</b></a>
                                    </li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="#"><img src="img/icon/heart.png" alt=""></a>
                        <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div> -->
    </div>
</header>