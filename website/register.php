<?php
require("connection.php");
require("mail_sender_func.php");
?>
<?php
$file_name = "register";
?>
<?php require("top.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<title>Register /</title>
<?php require("navbar.php"); ?>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<div class="ls_div">
    <div class="forms">
        <div class="row m-0 ">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <form method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Enter your name" name="name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" name="password" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-phone-alt"></i>
                                <input type="number" placeholder="Enter your Mobile No" name="mobile_no" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" placeholder="Enter your Residing Address" name="address_1" required>
                            </div>
                            <div class="button input-box">
                                <button class="l_btn" type="submit" name="btn_add">Register</button>
                            </div>
                            <div class="text sign-up-text">Already have an account?<a href="login.php"> <label for="flip">Login</label></a></div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['btn_add'])) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $mobile = $_POST['mobile_no'];
                        $address_1 = $_POST['address_1'];
                        $date = date('Y-m-d H:i:s');

                        $v_code = bin2hex(random_bytes(16));
                        echo "<script>alert($v_code);</script>";
                        // Check if user already exists
                        $query = mysqli_query($connection, "SELECT * FROM users WHERE user_email='$email'");
                        if (mysqli_num_rows($query) > 0) {
                            echo "<script>alert('Email Already Exists');</script>";
                        } else {
                            $insert_query = mysqli_query($connection, "INSERT INTO users (user_name, user_email, user_password, user_mobile, user_address_1, verification_code, added_on) VALUES ('$name', '$email', '$password', '$mobile', '$address_1', '$v_code', '$date')");

                            if ($insert_query) {
                                // Get the last inserted user ID
                                $user_id = mysqli_insert_id($connection);

                                // Insert notification for the new user
                                $insert_notification = mysqli_query($connection, "INSERT INTO  users_notification (users_id) VALUES ('$user_id')");

                                // Check if both insertions were successful and send mail
                                if ($insert_notification && mail_sender($email, $v_code)) {
                                    echo "<script>alert('Registration Successful');window.location.href='login.php'</script>";
                                } else {
                                    echo "<script>alert('Error in Registration');</script>";
                                }
                            } else {
                                echo "<script>alert('Error in Registration');</script>";
                            }
                        }
                    }
                    ?>
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>