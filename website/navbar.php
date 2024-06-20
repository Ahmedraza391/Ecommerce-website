<div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__nav__option">
            <ul class="mobile_links list-unstyled ">
                <li>
                    <a href="shopping_cart.php">Cart <i class='fas fa-shopping-cart ml-2 my-2'></i><span>0</span></a>
                </li>
            </ul>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3">
                    <div class="d-flex align-items-center">
                        <div class="header__logo">
                            <a href="index.php"><img src="img/logo.png" alt=""></a>
                        </div>
                        <div class="canvas__open"><i class="fa fa-bars"></i></div>

                        <div class="d-block d-md-none d-lg-none">
                            <?php
                            if (isset($_SESSION['login_user'])) {
                                $user_id = $_SESSION['login_user'];
                                $fetch_user = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $user_id");
                                $fetch_user_assoc = mysqli_fetch_assoc($fetch_user);
                                $fetch_user_name = $fetch_user_assoc['user_name'];
                                $first_character = substr($fetch_user_name, 0, 1);
                                echo "<div class='dropdown micro__content'>";
                                echo "<button class='btn dropdown-toggle d-flex align-items-center ' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <div class='user_dropdown'><h5>$first_character</h5></div>
                                    </button>";
                                echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                                echo "<a class='dropdown-item'  href='myorder.php'><b>My Order</b></a>";
                                echo "<a class='dropdown-item'  href='user_profile.php'><b>Profile</b></a>";
                                echo "<a class='dropdown-item'  href='logout_profile.php'><b>Logout</b></a>";
                                echo "</div>";
                                echo "</div>";
                            } else {
                                echo "<div class='micro__btn'><a href='login.php' class='btn btn-sm btn-danger'>Login / Register</a></div>";
                            }
                            ?>
                        </div>
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
                    <div class="d-none d-md-block d-lg-none">
                        <?php
                        if (isset($_SESSION['login_user'])) {
                            $user_id = $_SESSION['login_user'];
                            $fetch_user = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $user_id");
                            $fetch_user_assoc = mysqli_fetch_assoc($fetch_user);
                            $fetch_user_name = $fetch_user_assoc['user_name'];
                            $first_character = substr($fetch_user_name, 0, 1);
                            echo "<div class='dropdown d-lg-none'>";
                            echo "<button class='btn dropdown-toggle d-flex align-items-center ' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <div class='user_dropdown'><h5>$first_character</h5></div>
                                </button>";
                            echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                            echo "<a class='dropdown-item'  href='myorder.php'><b>My Order</b></a>";
                            echo "<a class='dropdown-item'  href='user_profile.php'><b>Profile</b></a>";
                            echo "<a class='dropdown-item'  href='logout_profile.php'><b>Logout</b></a>";
                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='micro__btn'><a href='login.php' class='btn btn-sm btn-danger'>Login / Register</a></div>";
                        }
                        ?>
                    </div>
                    <div class="header__nav__option">
                        <a href="categories_products.php" id="search_product" class="search-switch"><img src="img/icon/search.png" alt="" title="Search Products"></a>
                        <?php
                        if (isset($_SESSION['login_user'])) {
                            $fetch_cart_count = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = $_SESSION[login_user]");
                            if (mysqli_num_rows($fetch_cart_count) > 0) {
                                $count = mysqli_num_rows($fetch_cart_count);
                            } else {
                                $count = 0;
                            }
                        } else {
                            $count = 0;
                        }
                        ?>
                        <a href="shopping_cart.php" title="Shopping Cart"><img src="img/icon/cart.png" alt=""><span class="font-weight-bold text-danger "><?php echo $count; ?></span></a>

                        <div class="dropdown">
                            <button class="btn dropdown-toggle d-flex align-items-center " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                if (isset($_SESSION['login_user'])) {
                                    $user_id = $_SESSION['login_user'];
                                    $fetch_user = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $user_id");
                                    $fetch_user_assoc = mysqli_fetch_assoc($fetch_user);
                                    $fetch_user_name = $fetch_user_assoc['user_name'];
                                    $first_character = substr($fetch_user_name, 0, 1);
                                    echo "<div class='user_dropdown'><h5>$first_character</h5></div>";
                                } else {
                                    echo "<i class='far fa-user'></i>";
                                }
                                ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                if (isset($_SESSION['login_user'])) {
                                    echo "<a class='dropdown-item'  href='myorder.php'><b>My Order</b></a>";
                                    echo "<a class='dropdown-item'  href='user_profile.php'><b>Profile</b></a>";
                                    echo "<a class='dropdown-item'  href='logout_profile.php'><b>Logout</b></a>";
                                } else {
                                    echo "<a class='dropdown-item'  href='login.php'><b>Login</b></a>";
                                    echo "<a class='dropdown-item'  href='register.php'><b>Singup</b></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>