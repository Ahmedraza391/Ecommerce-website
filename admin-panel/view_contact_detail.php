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
<div id="content-wrapper" class="d-flex flex-column  m-0">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="container most_margin">
            <div class="row m-0">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="container bg-light shadow p-md-5 mb-5 bg-light rounded">
                        <div class="row">
                            <?php 
                                $fetch = mysqli_query($connection,"SELECT * FROM contact_us WHERE id = $_GET[id]");
                                $user = mysqli_fetch_assoc($fetch);
                            ?>
                            <div class="col-md-12"> 
                                <div class="heading card text-center text-dark">
                                    <h2>Contacted User</h2>
                                </div>
                                <div class="card p-3">
                                    <div class="name">
                                        <h5 class="font-weight-bold text-primary m-0">Name : </h5><h6 class="ml-3 font-weight-bold "><?php echo $user['name']; ?></h6>
                                    </div>
                                    <div class="email">
                                        <h5 class="font-weight-bold text-primary">Email : </h5><h6 class="ml-3 font-weight-bold "><?php echo $user['email']; ?></h6>
                                    </div>
                                    <div class="mobile">
                                        <h5 class="font-weight-bold text-primary">Mobile No : </h5><h6 class="ml-3 font-weight-bold "><?php echo $user['mobile']; ?></h6>
                                    </div>
                                    <div class="message">
                                        <h5 class="font-weight-bold text-primary">Message : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $user['comment']; ?></p>
                                    </div>
                                    <div class="date">
                                        <h5 class="font-weight-bold text-primary">Date / Time : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $user['added_on']; ?></h6>
                                    </div>
                                    <div class="button">
                                        <?php
                                            $url ="";
                                            if($_GET['message']=="notification"){
                                                $url = "contact_notification.php?message=update_contact";
                                            }else{
                                                $url = "contact.php";
                                            }
                                        ?>
                                        <button class="btn btn-primary"><a href="<?php echo $url; ?>" class="text-decoration-none text-white">Back</a></button>
                                    </div>
                                </div>
                            </div>
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