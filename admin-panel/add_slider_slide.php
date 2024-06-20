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
<div id="content-wrapper" class="d-flex flex-column ">

    <!-- Main Content -->
    <div id="content">

        <?php include("navbar.php"); ?>
        <div class="container most_margin">
            <div class="row m-0 ">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="container w-100  bg-light shadow p-1 mb-5 bg-light rounded">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row py-5">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <a href="slider.php">
                                    <button class="btn btn-primary font-weight-bolder"> / Back</button>
                                </a>
                                <div class="text-center d-flex justify-content-center my-3">
                                    <h2 class="text-dark border-bottom border-dark w-50 font-weight-bold">Add Slider slide</h2>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                    <select name="product" class="custom-select mb-3" required>
                                        <option value="" hidden>Select Product</option>
                                        <?php
                                        $fetch_category_query = "SELECT * FROM products";
                                        $fetch_category_result = mysqli_query($connection, $fetch_category_query);
                                        $id = null;
                                        foreach ($fetch_category_result as $fetch) {
                                            echo "<option value='$fetch[id]'>$fetch[name]</option>";
                                            $id .= $fetch['id'];
                                        }
                                        ?>
                                    </select>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="p_image" name="p_image">
                                            <label class="custom-file-label" for="p_image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="p_desc" placeholder="Enter Product Description" required>
                                    </div>
                                    <div class="button my-2">
                                        <a href="categories.php">
                                            <button class="btn btn-success px-5" type="submit" name="btn_add">Add</button>
                                        </a>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['btn_add'])) {
                                    $p_desc = $_POST['p_desc'];
                                    $product = $_POST['product'];
                                    $img_name = $_FILES['p_image']['name'];
                                    $tmp_name = $_FILES['p_image']['tmp_name'];
                                    $allowed_extensions = array('jpg', 'png', 'jpeg');
                                    $file_extension = pathinfo($img_name, PATHINFO_EXTENSION);
                                    if (!in_array($file_extension, $allowed_extensions)) {
                                        echo "<script>alert('Please Select png / jpg / jpeg format images');";
                                    } else {
                                        $folder = "img/web_image/slider_image/$product";
                                        if (!file_exists($folder)) {
                                            mkdir($folder, 0777, true);
                                            $folder = "img/web_image/slider_image/$product/$img_name";
                                            if (move_uploaded_file($tmp_name, $folder)) {
                                                $insert_query = "INSERT INTO tbl_slider(product_id,product_image,product_desc,anchor_page)VALUES ('$product','$folder','$p_desc','product_details.php?id=$product')";
                                                $run_query = mysqli_query($connection, $insert_query);
                                                if ($run_query) {
                                                    echo "<script>alert('Slider Slide Added Successfully');window.location.href = 'slider.php'</script>";
                                                }else{
                                                    echo "<script>alert('error 1');</script>";
                                                }
                                            }else{
                                                echo "<script>alert('error 2');</script>";
                                            }
                                        }else{
                                            echo "<script>alert('error 3');</script>";
                                        }
                                    }
                                }
                                ?>
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
<?php include("bottom_page.php") ?>