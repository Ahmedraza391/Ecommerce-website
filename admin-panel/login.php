<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="d-flex align-items-center justify-content-center" style="width: 100%;height: 80vh;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row">

            <div class="col-lg-12 col-md-12 ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-white border-right border-primary"><img src="./img/Login-page-character1.png" style="width: 100%; height:100%;object-fit: cover; " alt=""></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                    </div>
                                    <?php 
                                        session_start();
                                        include("connection.php");
                                        if(isset($_POST['login_btn'])){
                                            $u_name = $_POST['username'];
                                            $u_password = $_POST['password'];
                                            $result = mysqli_query($connection,"SELECT * FROM admin_users WHERE username = '$u_name' and password = '$u_password'");
                                            $fetch = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM admin_users WHERE username = '$u_name' and password = '$u_password'"));
                                            $row = mysqli_num_rows($result);
                                            if($row){
                                                $_SESSION["login"] = $u_name;
                                                $_SESSION["login_id"] = $fetch['id'];
                                                header('location:index.php');
                                            }else{
                                                $msg = "Invalid Username or Password";
                                            }
                                        }

                                    ?>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                        </div>
                                        <div class="bg-black my-2 d-flex justify-content-center ">
                                            <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block w-50">
                                                Login
                                            </button>
                                        </div>
                                        <div class="bg-black my-2 d-flex justify-content-center ">
                                            <span class="text-danger"><?php if(isset($_POST['login_btn'])){
                                             echo $msg; }?></span>
                                                
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>