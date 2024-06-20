    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <div class="payment_images">
                            <ul>
                                <li>
                                    <img src="img/jazzcahs.jpg" alt="">
                                </li>
                                <li>
                                    <img src="img/easypaisa.jpg" alt="">
                                </li>
                                <li>
                                    <img src="img/cod.png" alt="">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer__widget">
                        <h6>Web Links</h6>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="categories_products.php">Explore Products</a></li>
                            <li><a href="index.php">Top Sales</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer__widget">
                        <h6>Categories</h6>
                        <ul>
                            <?php 
                                $fetch_query = mysqli_query($connection,"SELECT * FROM categories WHERE status = 1 LIMIT 4");
                                foreach($fetch_query as $fetch){
                                    echo "<li><a href='categories_products.php?c_id=$fetch[id] '>$fetch[categories]</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="footer__widget">
                        <div class="address">
                            <h6>Outlets</h6>
                            <ul>
                                <li>Shop No 422 Street No 8 Main Saddar Karachi.</li>
                            </ul>
                        </div>
                        <div class="social_media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <p>Copyright © <span id="copyrightYear"></span> All rights reserved | Ahmed Raza </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>