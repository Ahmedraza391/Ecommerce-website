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
                                <a href="order.php">
                                    <button class="btn btn-primary font-weight-bolder"> / Back</button>
                                </a>
                                <div class="text-center d-flex justify-content-center my-3">
                                    <h2 class="text-dark border-bottom border-dark fw-bold ">Update Status</h2>
                                </div>

                                <?php 
                                    $order_id = $_GET['id'];
                                    if(isset($_POST['set_btn'])){
                                        $status = $_POST['order_status'];
                                        $query = "UPDATE user_order SET order_status = '$status' WHERE id = $order_id";
                                        $run_query = mysqli_query($connection,$query);
                                        if($run_query){
                                            echo "<script>alert('Status Updated Successfully');</script>";
                                        }
                                    }
                                    $check_query = mysqli_query($connection,"SELECT * FROM user_order WHERE id = $order_id");
                                    $fetch = mysqli_fetch_assoc($check_query);
                                    // if($fetch['order']=="cancelled"){echo "selected";}
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                        <select name="order_status" class="custom-select mb-3" required>
                                        <option hidden>Select Status</option>
                                        <option value="pending" <?php if($fetch['order_status']=="pending"){echo "selected";} ?> >Pending</option>
                                        <option value="shipped" <?php if($fetch['order_status']=="shipped"){echo "selected";} ?> >Shipped</option>
                                        <option value="delivered" <?php if($fetch['order_status']=="delivered"){echo "selected";} ?> >Delivered</option>
                                        <option value="cancelled" <?php if($fetch['order_status']=="cancelled"){echo "selected";} ?> >Cancelled</option>
                                    </select>
                                    </div>
                                    <div class="button my-2">
                                        <a href="categories.php">
                                            <button class="btn btn-success px-5" type="submit" name="set_btn" >Set Status</button>
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