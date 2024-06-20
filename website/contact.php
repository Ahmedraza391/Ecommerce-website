<?php 
    session_start();    
    require("top.php"); 
?>
<?php
    require("connection.php");
?>
    <title>Contact Us /</title>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require("navbar.php"); ?>
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
                        <form method="POST" id="contact_form">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <input type="text" id="name" placeholder="Enter Your Name" name="name" class="">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="text" id="email" placeholder="Enter Your Email" name="email" class="">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <input type="number" id="mobile" placeholder="Enter Your Mobile No" name="mobile" class="">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <textarea placeholder="Enter Your Message" name="message" id="message" class=""></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="site-btn" name="send_btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['send_btn'])){
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $mobile = $_POST['mobile'];
                                $message = $_POST['message'];
                                date_default_timezone_set('Asia/Karachi');
                                $added_on = date('d-m-Y h:i:s');
                                $insert_query = "INSERT INTO contact_us (name, email, mobile, comment, added_on) VALUES ('$name', '$email', '$mobile', '$message', '$added_on')";
                                $run_query = mysqli_query($connection, $insert_query);  

                                if($run_query){
                                    $insert_contact_notification = mysqli_query($connection,"INSERT INTO contact_notification (contact_id) VALUES($_SESSION[login_user])");
                                    echo "<br><span class='text-success font-weight-bold' >Message sent successfully.</span>";
                                } else {
                                    echo "Error: " . mysqli_error($connection);
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require("footer.php"); ?>
<?php require("bottom.php"); ?>
