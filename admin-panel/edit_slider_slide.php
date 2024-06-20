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
        <div class="container most_margin">
            <div class="row m-0">
                <div class="col-md-2 "></div>
                <div class="col-md-10 ">
                    <div class="content shadow p-5 mb-5 mx-2 bg-body-tertiary rounded">
                        <a href="slider.php">
                            <button class="btn btn-primary font-weight-bolder"> / Back</button>
                        </a>
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                            <h1 class="h3 mb-0 text-gray-800 border-primary border-bottom font-weight-bold">Edit / Update Slider Slide</h1>
                        </div>
                        <?php
                        $id = $_GET['id'];
                        $query = "SELECT tbl_slider.*,tbl_slider.status as 's_status',products.*,products.id as 'p_id' FROM tbl_slider INNER JOIN products ON tbl_slider.product_id = products.id WHERE tbl_slider.id = $id ";
                        $result = mysqli_query($connection, $query);
                        $num = mysqli_num_rows($result);
                        if ($num > 0) {
                            $fetch = mysqli_fetch_assoc($result);
                        } else {
                            echo "<script>
                                    window.location.href = 'categories.php';    
                                </script>";
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="prod" class="p-1 m-0">Products</label>
                                <select name="product" id="prod" class="custom-select mb-3">
                                    <option value="" hidden>Select Product</option>
                                    <?php
                                    $find_pro = mysqli_query($connection, "SELECT * FROM products");
                                    foreach ($find_pro as $pro) {
                                        if ($pro['id'] == $fetch['p_id']) {
                                            echo "<option value='$fetch[p_id]' selected>$pro[name]</option>";
                                        } else {
                                            echo "<option value='$pro[id]'>$pro[name]</option>";
                                        }
                                    }
                                    ?>
                                </select>

                                <!-- <input type="hidden" value="<?php $fetch['anchor_page'] ?>" name="anchor"> -->

                                <label for="desc" class="p-1 m-0">Slide Product Description</label>
                                <input type="text" name="p_desc" id="desc" value="<?php echo $fetch['product_desc'] ?>" class="form-control mb-3" placeholder="Enter Category Name">

                                <label for="status" class="p-1 m-0">Status</label>
                                <input type="text" id="status" readonly value="<?php if ($fetch['s_status'] == "show") {
                                    echo "show";
                                } else {
                                    echo "hide";
                                } ?>" class="form-control">
                            </div>
                            <button type="submit" name="btn_update" class="btn btn-primary">Update Slide</button>
                        </form>
                        <?php
                        if (isset($_POST['btn_update'])) {
                            $id = $_GET['id'];
                            $desc = $_POST['p_desc'];
                            $product = $_POST['product'];
                            $update_query = "UPDATE tbl_slider SET product_desc='$desc',product_id='$product',anchor_page='product_details.php?id=$product' WHERE id = $id";
                            $run_update_query = mysqli_query($connection, $update_query);
                            if ($run_update_query) {
                                echo "<script>
                                    alert('Slider Slide Updated Successfully');
                                    window.location.href = 'slider.php';
                                </script>";
                            }
                        }?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="image_update my-3">
                                <div class="text">
                                    <h4>Update Slide Image</h4>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="p_image" name="p_image" required value="ahmed">
                                        <label class="custom-file-label" for="p_image">Choose file</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="image_update">Update Slide Image</button>
                            </div>
                        </form>


                        <?php
                        if(isset($_POST['image_update'])){
                            $fetch_pro = mysqli_query($connection,"SELECT * FROM tbl_slider WHERE id = $id");
                            $product_fetched = mysqli_fetch_assoc($fetch_pro); 
                            $product = $product_fetched['product_id'];
                            $p_image = $_FILES['p_image']['name'];
                            $tmp_name = $_FILES['p_image']['tmp_name'];
                            $allowed_extension = array('png','jpg','jpeg');
                            $file_extension = pathinfo($p_image,PATHINFO_EXTENSION);
                            if(!in_array($file_extension,$allowed_extension)){
                                echo "<script>alert('Please Select png / jpg / jpeg format images')</script>";
                            }else{
                                $path = "img/web_image/slider_image/$product/$p_image";
                                move_uploaded_file($tmp_name, $path);
                                $update_query = "UPDATE tbl_slider SET product_image='$path' WHERE id = $id";
                                $run_update_query = mysqli_query($connection, $update_query);
                                if ($run_update_query) {
                                    echo "<script>
                                        alert('Slider Slide Image Updated Successfully');
                                        window.location.href = 'slider.php';
                                    </script>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Page Content -->

    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php"); ?>