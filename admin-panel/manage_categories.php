<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
?>
<?php include("top_page.php") ?>
<?php include("sidebar.php"); ?>

 <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include("navbar.php"); ?>
        <div class="container most_margin">
            <div class="row m-0">
                <div class="col-md-2 "></div>
                <div class="col-md-10 ">
                    <div class="container bg-light shadow p-1 mb-5 bg-light rounded">
                        <div class="row py-5">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <a href="categories.php">
                                    <button class="btn btn-primary font-weight-bolder"> / Back</button>
                                </a>
                                <div class="text-center d-flex justify-content-center my-3">
                                    <h2 class="text-dark border-bottom border-dark w-25 fw-bold ">Categoires</h2>
                                </div>
                                <?php 
                                    if(isset($_POST['btn_add'])){
                                        $cate = $_POST['category'];
                                        $check = mysqli_query($connection,"SELECT * FROM categories WHERE categories = '$cate'");
                                        $count = mysqli_num_rows($check);
                                        if($count > 0){
                                            $msg = "Category Already Exists";
                                        }else{
                                            $query_table = "INSERT INTO categories (categories,status) VALUES ('$cate','1')";
                                            $result = mysqli_query($connection, $query_table);
                                            if($result){
                                                echo "<script>window.location.href = 'categories.php'</script>";
                                            }
                                        }
                                    }


                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="category" placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="button my-2">
                                        <a href="categories.php">
                                            <button class="btn btn-success px-5" type="submit" name="btn_add" >Add</button>
                                        </a>
                                    </div>
                                </form>
                                <span class="text-danger border-danger border-bottom py-1 font-weight-bold"><?php if(isset($_POST['btn_add'])){echo $msg;} ?></span>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

<?php include("bottom_page.php") ?>