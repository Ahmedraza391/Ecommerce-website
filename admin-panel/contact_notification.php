<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
$msg = $_GET['message'];
if($msg=="update_contact"){
    $update_contact = mysqli_query($connection,"UPDATE contact_notification SET status = 'seen'");
}
?>
<?php include("top_page.php"); ?>
<?php include("sidebar.php"); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>

        <!-- Main Page Content -->
        <div class="row m-0 most_margin">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <h2>Contacted Users</h2>
                    <?php
                    $query = "SELECT * FROM contact_us ORDER BY id DESC  LIMIT 10";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result)
                    ?>
                    <table class='table text-dark table-bordered table-striped <?php if($count < 1){echo "d-none";}else{echo ""; } ?> ' id="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <?php
                        if ($count > 0) {
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td>$row[id]</td>";
                                echo "<td>$row[name]</td>";
                                echo "<td>$row[email]</td>";
                                echo "<td>$row[comment]</td>";
                                echo "<td>$row[added_on]</td>";
                                echo "<td>
                                    <a href='view_contact_detail.php?id=$row[id] & message=notification'>
                                        <button class='btn btn-success px-2 btn-sm '>
                                            View
                                        </button>
                                    </a>
                                    <a href='delete_contact_detail.php?id=$row[id]' onclick='return checking()' >
                                        <button class='btn btn-danger px-2 btn-sm '>
                                            Delete
                                        </button>
                                    </a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {

                            echo "
                            <div id='contact_massage' class='text-light bg-secondary p-5 d-none justify-content-center'>
                                <h2>You Dont Have Massages</h2>
                            </div>
                            ";
                        }
                        ?>
                    </table>
                    <div class="button">
                        <a href="notification.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Page Content -->

    </div>
    <!-- End of Main Content -->
</div>
<script>
    function checking() {
        return confirm("Are you sure to Want Delete this Massage");
    }
</script>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php"); ?>