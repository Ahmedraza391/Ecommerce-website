<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
$query_table = "SELECT * FROM categories ORDER BY categories";
$result = mysqli_query($connection, $query_table);
?>
<?php include("top_page.php") ?>
<!-- Internal Css -->
<style>
    .overflow{
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        padding: 10px;
    }
    table{
        width: 100% !important;
        height: 100%;
        min-width: max-content;
    }
</style>
<!-- Internal Css -->
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
                    <div class="container bg-light shadow p-md-5 p-3 mb-5 bg-light rounded">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="text-center d-md-flex justify-content-center  ">
                                    <h2 class="text-dark border-bottom border-primary w-25 font-weight-bold">Categoires</h2>
                                </div>
                                <div class="overflow">
                                    <table class="table text-dark table-bordered table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Categories</th>
                                            <th>Status</th>
                                            <th>Operations</th>
                                        </thead>
                                        <?php
                                        foreach ($result as $row) {
                                            echo "<tr>";
                                            echo "<td>$row[id]</td>";
                                            echo "<td>$row[categories]</td>";
                                            echo "<td>";
                                            if ($row['status'] == 1) {
                                                echo
                                                "
                                                    <a href='deactivate_categories.php?id=$row[id]'>
                                                        <button class='btn btn-danger btn-sm '>Deactivate</button>
                                                    </a>
                                                ";
                                            } else {
                                                echo
                                                "
                                                    <a href='activate_categories.php?id=$row[id]'>
                                                        <button class='btn btn-success btn-sm px-3'>Activate</button>
                                                    </a>
                                                ";
                                            }
                                            echo "</td>";
                                            echo "<td>
                                                    <a href='delete_categories.php?id=$row[id]' onclick='return checking()' >
                                                        <button class='btn btn-danger px-2 btn-sm '>
                                                            Delete
                                                        </button>
                                                    </a>
                                                    <a href='edit_categories.php?id=$row[id]'>
                                                        <button class='btn btn-success px-3 btn-sm '>
                                                            Edit
                                                        </button>
                                                    </a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="button my-2">
                                    <a href="manage_categories.php" class="btn btn-primary">
                                        Add Category
                                    </a>
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
<script>
    function checking() {
        return confirm("Are you sure to Want Delete this Category");
    }
</script>
<?php include("bottom_page.php") ?>