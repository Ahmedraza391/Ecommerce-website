<?php
    session_start();
    require("connection.php");
    $file_name = "loign";
?>
<?php require("top.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<title>Login /</title>
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
                    <div class="login-form">
                        <div class="title">Login</div>
                        <form method="POST">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" placeholder="Enter your email" name="email" required>
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Enter your password" name="password" required>
                                </div>
                                <div class="text"><a href="#">Forgot password?</a></div>
                                <div class="button input-box">
                                    <button class="l_btn" type="submit" name="btn_login">Login</button>
                                </div>
                                <div class="text sign-up-text">Don't have an account?<a href="register.php"> <label for="flip">Register Now</label></a></div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_login'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $query = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password' ";
                            $result = mysqli_query($connection, $query);
                            $row = mysqli_num_rows($result);
                            if ($row) {
                                $fetch = mysqli_fetch_assoc($result);
                                $_SESSION["login_user"] = $fetch['user_id'];
                                $check_verification = mysqli_query($connection,"SELECT * FROM users WHERE user_id = $_SESSION[login_user]");
                                $check_verification_fetch = mysqli_fetch_assoc($check_verification);
                                if($check_verification_fetch['is_verified']==0){
                                    echo "<script>alert('We send You Verification Link Click the link and Verify your self otherwise You are not logged in ');window.location.href='login.php'</script>";
                                    $_SESSION['login_user']=null;
                                }else{
                                    echo "<script>window.location.href='index.php'</script>";
                                }
                            } else {
                                echo "<script>alert('Invalid Email or Password')</script>";
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