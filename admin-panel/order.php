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
        height: 50vh;
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
                                                    <input type="number" class="form-control bg-light border-0 small" placeholder="Search Orders By ID" aria-label="Search" aria-describedby="basic-addon2" id="order_id" >
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center d-flex justify-content-center  ">
                                        <h2 class="text-dark border-bottom border-dark w-25 fw-bold ">Orders</h2>
                                    </div>
                                    <div class="overflow w-100 " id="table_div">
                                        <table class="table text-dark table-bordered table-striped" id="old_table">
                                            <thead>
                                                <th>Order ID</th>
                                                <th>User Name</th>
                                                <th>Product Name</th>
                                                <th>Product Image</th>
                                                <th>Total Price</th>
                                                <th>Order Status</th>
                                                <th>Update Status</th>
                                                <th>View Order</th>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php
                                                $query_table = "SELECT users.*,users.user_name as 'u_name',order_details.*, user_order.*, products.*,products.name as 'p_name' FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id INNER JOIN products ON order_details.product_id = products.id INNER JOIN users ON order_details.user_id = users.user_id";                                                
                                                $result = mysqli_query($connection, $query_table);
                                                foreach ($result as $row) {
                                                    echo "<tr class='text-center'>";
                                                    echo "<td class='align-middle'>$row[order_id]</td>";
                                                    echo "<td class='align-middle'>$row[u_name]</td>";
                                                    echo "<td class='align-middle'>$row[p_name]</td>";
                                                    echo "<td class='align-middle'><img src='$row[image]' width='150px' height='70px'/></td>";
                                                        echo "<td class='align-middle'>$row[product_price]</td>";
                                                        echo "<td class='align-middle'>$row[order_status]</td>";
                                                            echo "<td class='align-middle'>
                                                                <a href='update_order.php?id=$row[order_id]'>
                                                                    <button class='btn btn-success px-3 btn-sm '>
                                                                        Update Status
                                                                    </button>
                                                                </a>
                                                            </td>";
                                                            echo "<td class='align-middle'>
                                                                <a href='view_order.php?id=$row[order_id] & message=order'>
                                                                    <button class='btn btn-success px-3 btn-sm '>
                                                                        View
                                                                    </button>
                                                                </a>
                                                            </td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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