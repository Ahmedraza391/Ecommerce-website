<?php require("connection.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION['login_user'])){
        echo "<script>window.location.href = 'login.php'</script>";
    }
?>
<?php require("top.php"); ?>
<title>Profile /</title>
<?php require("navbar.php"); ?>
<section class="profile_section">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="profile_form">
                    <?php 
                        $query = "SELECT * FROM users WHERE user_id = $_SESSION[login_user]";
                        $result = mysqli_query($connection,$query);
                        $fetch = mysqli_fetch_assoc($result);
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="u_name">Name</label>
                            <input type="text" class="form-control" value="<?php echo $fetch['user_name'] ?>" name="u_name" id="u_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="<?php echo $fetch['user_email'] ?>" name="u_email"  id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" value="<?php echo $fetch['user_password'] ?>" name="u_password"  id="password">
                        </div>
                        <div class="form-group">
                            <label for="no">Mobile No</label>
                            <input type="number" placeholder="Enter Mobile No" class="form-control" value="<?php echo $fetch['user_mobile'] ?>" name="u_mobile"  id="no">
                        </div>
                        <div class="form-group">
                            <label for="addres">Address</label>
                            <input type="text" placeholder="Enter Address" class="form-control" value="<?php echo $fetch['user_address_1'] ?>" name="u_address" id="addres">
                        </div>
                        <div class="form-group">
                            <?php 
                                if($fetch['is_verified']==1){
                                    echo "<h5>
                                        Verified <i class='fas fa-check-circle text-success'></i>
                                    </h5>";
                                }else{
                                    echo "<h4>
                                    <i class='far fa-exclamation-circle'></i>
                                    </h4>";
                                }
                            ?>
                        </div>
                        <button type="submit" name="update_btn" class="btn btn-dark">Update Profile</button>
                    </form>
                    <?php
                        if(isset($_POST['update_btn'])){
                            $name = $_POST['u_name'];
                            $email = $_POST['u_email'];
                            $password = $_POST['u_password'];
                            $mobile = $_POST['u_mobile'];
                            $address = $_POST['u_address'];
                            $u_query = "UPDATE users SET user_name='$name',user_email='$email',user_password='$password',user_mobile='$mobile',user_address_1 = '$address' WHERE user_id = $_SESSION[login_user]";
                            $u_res = mysqli_query($connection,$u_query);
                            if($u_res){
                                echo "<script>alert('Profile Updated Successfully');window.location.href = 'user_profile.php'</script>";
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
<?php require("footer.php"); ?>
<?php require("bottom.php"); ?>