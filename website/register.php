<?php require("connection.php"); ?>
<?php
    $file_name = "register";
?>
<?php require("top.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<title>Register /</title>
<?php require("navbar.php"); ?>
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
                                <input type="text" placeholder="Enter your name" name="name"  required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your email" name="email"  required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" name="password"  required>
                            </div>
                            <div class="button input-box">
                                <button class="l_btn" type="submit" name="btn_add">Register</button>
                            </div>
                            <div class="text sign-up-text">Already have an account?<a href="login.php"> <label for="flip">Login</label></a></div>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['btn_add'])){
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $date = date('Y-m-d H:i:s');
                            $if_user_exists = mysqli_query($connection,"SELECT * FROM users");
                            $fetch_user = mysqli_fetch_assoc($if_user_exists);
                            if($fetch_user['user_email'] != $email){
                                $query = mysqli_query($connection,"INSERT INTO users (user_name,user_email,user_password,added_on)VALUES('$name','$email','$password','$date')");
                                if($query){
                                    echo "<script>alert('Regsitration Successfull');window.location.href='login.php'</>";
                                }
                            }else{
                                echo "<script>alert('Email Already Exists');</script>";
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