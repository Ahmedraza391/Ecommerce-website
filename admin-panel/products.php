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
<!-- Internal Css -->
<style>
    .overflow {
        width: 900px;
        height: 60vh;
        overflow: auto;
        /* overflow-y: auto; */
        padding: 10px;
    }

    table {
        width: 90%;
        min-width: max-content;
    }
    table>td {
        padding: 0 !important;
    }
</style>
<!-- Internal Css -->
<?php include("sidebar.php"); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="row m-0 most_margin">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="row m-0">
                    <div class="col-md-12">
                        <div class="container my-3 bg-light shadow m-2 p-md-5 bg-light rounded">
                            <div class="row m-0">
                                <div class="col-md-12">
                                    <!-- Search bar -->
                                    <div class="row m-0 bg-dark p-3 my-2">
                                        <div class="col-md-12">
                                            <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 w-100 navbar-search">
                                                <div class="input-group">
                                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search Products By Product Name" aria-label="Search" aria-describedby="basic-addon2" id="p_name" >
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center d-flex justify-content-center  ">
                                        <h2 class="text-dark border-bottom border-primary w-25 font-weight-bold">Products</h2>
                                    </div>
                                    <div class="overflow w-100 " id="table_div">
                                        <table class="table text-dark table-bordered table-striped" id="old_table">
                                            <thead>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Product Image</th>
                                                <th>Product Category</th>
                                                <th>Product M.R.P</th>
                                                <th>Product Price</th>
                                                <th>Product Qty</th>
                                                <th>Product Status</th>
                                                <th>Operations</th>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php
                                                $query_table = "SELECT products.*,products.id as p_id,products.status as p_status,categories.* FROM products INNER JOIN categories ON products.categories_id = categories.id";
                                                $result = mysqli_query($connection, $query_table);
                                                foreach ($result as $row) {
                                                    echo "<tr class='text-center'>";
                                                    echo "<td class='align-middle'>$row[p_id]</td>";
                                                    echo "<td class='align-middle'>$row[name]</td>";
                                                    echo "<td class='align-middle'><img src='$row[image]' width='150px' height='70px'/></td>";
                                                    echo "<td class='align-middle'>$row[categories]</td>";
                                                        echo "<td class='align-middle'>Rs $row[mrp]/-</td>";
                                                        echo "<td class='align-middle'>Rs $row[price]/-</td>";
                                                        echo "<td class='align-middle'>$row[qty]</td>";
                                                        echo "<td class='align-middle'>";
                                                            if ($row['p_status'] == 1) {
                                                                echo
                                                                "
                                                                <a href='deactivate_products.php?id=$row[p_id]'>
                                                                    <button class='btn btn-danger btn-sm '>Deactivate</button>
                                                                </a>
                                                            ";
                                                            } else {
                                                                echo
                                                                "
                                                                <a href='activate_products.php?id=$row[p_id]'>
                                                                    <button class='btn btn-success btn-sm px-3'>Activate</button>
                                                                </a>
                                                            ";
                                                            }
                                                        echo "</td>";
                                                        echo "<td class='align-middle'>
                                                            <a href='delete_products.php?id=$row[p_id]' onclick='return checking()' >
                                                                <button class='btn btn-danger px-2 btn-sm '>
                                                                    Delete
                                                                </button>
                                                            </a>
                                                            <a href='edit_products.php?id=$row[p_id]'>
                                                                <button class='btn btn-success px-3 btn-sm '>
                                                                    Edit
                                                                </button>
                                                            </a>
                                                        </td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="button my-2">
                                        <a href="manage_products.php">
                                            <button class="btn btn-primary">Add Product</button>
                                        </a>
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
<!-- End of Content Wrapper
<?php include("bottom_page.php") ?>