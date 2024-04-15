<?php 
    session_start();
    if(!isset($_SESSION["login"])){
        header("location:login.php");
        // echo "<script>window.location.href = 'login.php'</script>";
    }else{
    }
    include("connection.php");

?>
<?php include("top_page.php"); ?>
    <?php include("sidebar.php"); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" >

            <?php include("navbar.php"); ?>
            <div class="row m-0 " style="margin-top: 100px !important;" >
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <!-- Main Page Content -->
                    <div class="container-fluid">
                        <?php 
                            $query = "SELECT * FROM admin_users WHERE id = $_SESSION[login_id]";
                            $result = mysqli_query($connection,$query);
                            $fetch = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row m-0 bg-light shadow m-2 p-md-5 bg-light rounded">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h2 class="text-center text-dark fs-1 border-bottom border-dark">Admin Profile</h2>
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="username" class="text-dark">Enter Admin Username</label>
                                        <input type="text" id="username" name="username" value="<?php echo $fetch['username'] ?>" class="form-control mb-3" placeholder="Username">
                                        <label for="password" class="text-dark">Enter Admin Password</label>
                                        <input type="text" id="password" name="password" value="<?php echo $fetch['password'] ?>" class="form-control mb-3" placeholder="Password">
                                    </div>
                                    <button type="submit" name="btn_update" class="btn btn-primary">Update Profile</button>
                                </form>
                                <?php 
                                    if(isset($_POST['btn_update'])){
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        $u_query = "UPDATE admin_users SET username = '$username',password = '$password' WHERE id = $_SESSION[login_id]";
                                        $u_result = mysqli_query($connection,$u_query);
                                        if($u_result)
                                        {
                                            echo "<script>
                                                alert('Profile Updated Successfully');
                                                window.location.href = 'admin_profile.php';
                                            </script>";
                                        }
                                    }
                                
                                ?>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <!-- Main Page Content -->
                </div>
            </div>

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->
<?php include("bottom_page.php"); ?>