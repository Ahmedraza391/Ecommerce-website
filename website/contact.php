<?php require("top.php"); ?>
<?php
    require("connection.php");
    $error = "";
    $placeholder = "";
?>
    <title>Contact Us /</title>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require("navbar.php"); ?>

    <!-- Map Begin -->
    <!-- <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div> -->
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Pakistan</h4>
                                <p>Main Sadar Near Impress Market Karachi.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <?php
                            if(isset($_POST['send_btn'])){
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $mobile = $_POST['mobile'];
                                $message = $_POST['message'];
                                if($name == ""){
                                    $error = 'border border-danger';
                                    $placeholder = 'Please Enter Name';
                                }else if($email == ""){
                                    $error = 'border border-danger';
                                    $placeholder = 'Please Enter Email';
                                }else if($mobile == ""){
                                    $error = 'border border-danger';
                                    $placeholder = 'Please Enter Mobile No';
                                }else if($message == ""){
                                    $error = 'border border-danger';
                                    $placeholder = 'Please Enter Message';
                                }else{
                                    date_default_timezone_set('Asia/Karachi');
                                    $inser_query = "INSERT INTO contact_us (name,email,mobile,comment,added_on)VALUES('$name','$email','$mobile','$message',date('d-m-Y h:i:s')";
                                    $run_query = mysqli_query($connection,$inser_query);
                                }
                            }
                        ?>
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="<?php echo $placeholder;?>" name="name" class="<?php echo $error;?>">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="<?php echo $placeholder;?>" name="email" class="<?php echo $error;?>">
                                </div>
                                <div class="col-lg-12">
                                    <input type="number" placeholder="<?php echo $placeholder;?>" name="mobile" class="<?php echo $error;?>">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="<?php echo $placeholder;?>" name="message" class="<?php echo $error;?>"></textarea>
                                    <button type="submit" class="site-btn" name="send_btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <?php require("footer.php"); ?>
<?php require("bottom.php"); ?>