<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
} else {
}
include("connection.php");
$msg = $_GET['message'];
if($msg=="update_user"){
    $update_user = mysqli_query($connection,"UPDATE users_notification SET status = 'seen'");
}
?>
<?php include("top_page.php"); ?>
<?php include("sidebar.php"); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="row m-0 most_margin">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <!-- Main Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">User's Notifications</h1>
                    </div>
                    <?php
                    $query = "SELECT * FROM users ORDER BY  user_id DESC LIMIT 10";
                    $result = mysqli_query($connection, $query);
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overflow">
                                <table class="table text-dark table-bordered table-striped">
                                    <thead>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>User Phone</th>
                                        <th>User Added On</th>
                                        <!-- <th>/Operations</th> -->
                                    </thead>
                                    <?php
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>#$row[user_id]</td>";
                                        echo "<td>$row[user_name]</td>";
                                        echo "<td>$row[user_email]</td>";
                                        echo "<td>$row[user_mobile]</td>";
                                        echo "<td>$row[added_on]</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="button">
                                <a href="notification.php" class="btn btn-primary mb-2">Back</a>
                            </div>
                        </div>
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