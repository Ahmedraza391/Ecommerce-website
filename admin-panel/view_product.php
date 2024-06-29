<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location:login.php");
    // echo "<script>window.location.href = 'login.php'</script>";
} else {
}
include("connection.php");
$fetch = mysqli_query($connection, "SELECT * FROM products WHERE id = $_GET[id]");
$product = mysqli_fetch_assoc($fetch);
?>
<?php include("top_page.php") ?>
<title><?php echo $product['name'] ?></title>
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
                            <div class="col-md-12">
                                <div class="heading card text-center text-dark p-2">
                                    <h2>Product Details</h2>
                                </div>
                                <div class="card p-3">
                                    <div class="product_image" style="height: 350px;">
                                        <img src="../admin-panel/<?php echo $product['image'] ?>" alt="<?php $product['name'] ?>"style="width: 100%;height:100%;object-fit:contain;">
                                    </div>
                                    <div class="product_id">
                                        <h5 class="font-weight-bold text-primary m-0">Product ID : </h5>
                                        <h6 class="ml-3 font-weight-bold ">#<?php echo $product['id']; ?></h6>
                                    </div>
                                    <div class="product_name">
                                        <h5 class="font-weight-bold text-primary">Product Name : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $product['name']; ?></h6>
                                    </div>
                                    <div class="product_mrp">
                                        <h5 class="font-weight-bold text-primary">Product Mrp : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $product['mrp']; ?></h6>
                                    </div>
                                    <div class="product_price">
                                        <h5 class="font-weight-bold text-primary">Product Price : </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $product['price']; ?></h6>
                                    </div>
                                    <div class="product_qty">
                                        <h5 class="font-weight-bold text-primary">Product Qty : </h5>
                                        <p class="ml-3 font-weight-bold "><?php echo $product['qty']; ?></p>
                                    </div>  
                                    <div class="short_desc">
                                        <h5 class="font-weight-bold text-primary">Short Description: </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $product['short_desc']; ?></h6>
                                    </div>
                                    <div class="description">
                                        <h5 class="font-weight-bold text-primary">Description: </h5>
                                        <h6 class="ml-3 font-weight-bold "><?php echo $product['description']; ?></h6>
                                    </div>
                                </div>
                                <div class="button my-2">
                                    <a href="products.php" class="btn btn-primary">Back</a>
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