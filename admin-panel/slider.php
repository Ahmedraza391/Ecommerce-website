<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
$query_table = "SELECT tbl_slider.*,tbl_slider.id as 's_id',tbl_slider.status as 's_status',products.* FROM tbl_slider INNER JOIN products ON tbl_slider.product_id = products.id";
$result = mysqli_query($connection, $query_table);
$count = mysqli_num_rows($result);
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
                        <div class="container bg-light shadow p-md-5 mb-5 bg-light rounded">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="text-center d-md-flex justify-content-center  ">
                                        <h2 class="text-dark border-bottom border-primary w-25 font-weight-bold">Categoires</h2>
                                    </div>
                                    <div class="button my-2">
                                        <a href="add_slider_slide.php">
                                            <button class="btn btn-primary">Add Slide</button>
                                        </a>
                                    </div>
                                    <div class="overflow">
                                        <table class="table text-dark table-bordered table-striped">
                                            <thead>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Product Description</th>
                                                <th>Status</th>
                                                <th>Operations</th>
                                            </thead>
                                            <?php
                                            if($count > 0){
                                                foreach ($result as $row) {
                                                    // Truncate product description if it's too long
                                                    $description = $row['product_desc'];
                                                    if(strlen($description) > 50) { // Adjust the number as needed
                                                        $description = substr($description, 0, 47) . '...'; // Adjust the number 47 as needed to fit within your desired length
                                                    }
                                                    
                                                    echo "<tr>";
                                                    echo "<td>{$row['s_id']}</td>";
                                                    echo "<td>{$row['name']}</td>";
                                                    echo "<td>{$description}</td>";
                                                    echo "<td>";
                                                    
                                                    if ($row['s_status'] == "show") {
                                                        echo "
                                                            <a href='hide_slider_slide.php?id={$row['s_id']}'>
                                                                <button class='btn btn-danger btn-sm'>Hide</button>
                                                            </a>
                                                        ";
                                                    } else {
                                                        echo "
                                                            <a href='show_slider_slide.php?id={$row['s_id']}'>
                                                                <button class='btn btn-success btn-sm px-3'>Show</button>
                                                            </a>
                                                        ";
                                                    }
                                                    
                                                    echo "</td>";
                                                    echo "<td>
                                                            <a href='delete_slider_slide.php?id={$row['s_id']}' onclick='return checking()'>
                                                                <button class='btn btn-danger px-2 btn-sm'>Delete</button>
                                                            </a>
                                                            <a href='edit_slider_slide.php?id={$row['s_id']}'>
                                                                <button class='btn btn-success px-3 btn-sm'>Edit</button>
                                                            </a>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center'>Slider Products Not Found. Add products to view slides.</td></tr>";
                                            }
                                            ?>
                                        </table>
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
            return confirm("Are you sure to Want Delete this Slider Slide");
        }
    </script>
<?php include("bottom_page.php") ?>