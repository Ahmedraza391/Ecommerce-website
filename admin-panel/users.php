<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");

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
                    <h2>Users</h2>
                    <?php
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result)
                    ?>
                    <table class='table text-dark table-bordered table-striped <?php if($count < 1){echo "d-none";}else{echo ""; } ?> ' id="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Mobile No</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <?php
                        if ($count > 0) {
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td>$row[user_id]</td>";
                                echo "<td>$row[user_name]</td>";
                                echo "<td>$row[user_email]</td>";
                                echo "<td>$row[user_password]</td>";
                                echo "<td>$row[user_mobile]</td>";
                                echo "<td>$row[added_on]</td>";
                                echo "<td>
                                        <a href='delete_contact_detail.php?id=$row[user_id]' onclick='return checking()' >
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
                </div>
            </div>
        </div>
        <!-- Main Page Content -->

    </div>
    <!-- End of Main Content -->
</div>
<script>
    var x = document.getElementById("table");
    if (x.style.display === "block") {
        x.style.display = "none";
    }

    function checking() {
        return confirm("Are you sure to Want Delete this Massage");
    }
</script>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php"); ?>