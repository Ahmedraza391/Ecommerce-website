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
            <div class="row m-0 ">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="content shadow w-100 p-5 mb-5 mx-2 bg-body-tertiary rounded">
                        <a href="products.php">
                            <button class="btn btn-primary font-weight-bolder"> / Back</button>
                        </a>
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                            <h1 class="h3 mb-0 text-gray-800 border-dark border-bottom">Edit / Update Product</h1>
                        </div>
                        <?php
                            // for fetching product image
                            $id = $_GET['id'];
                            $image_query = "SELECT products.*,categories.categories as 'cname' FROM products INNER JOIN categories ON products.categories_id = categories.id WHERE products.id = $id";
                            $run_query = mysqli_query($connection, $image_query);
                            $f_image_q = mysqli_fetch_assoc($run_query);
                        ?>
                        <form method="POST" enctype="multipart/form-data" class="w-100">
                            <div class="image my-2 rounded">
                                <img src="<?php echo $f_image_q['image'] ?>" style="width: 100%; height: 400px;">
                                <div class="custom-file my-2">
                                    <input type="file" name="p_image" class="custom-file-input" id="customFile" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="button my-2 ">
                                    <input type="submit" value="Upload Image" name="image_btn" class="btn btn-primary ">
                                </div>
                        </form>
                        <?php
                            // for insert images
                            if (isset($_POST['image_btn'])) {
                                // $query = mysqli_query($connection,"SELECT * FROM products WHERE id = $id");
                                // $result = mysqli_fetch_assoc($query);
                                $category_id = $f_image_q['categories_id'];
                                $category_name = $f_image_q['cname'];
                                $name = $f_image_q['name'];
                                $image = $_FILES['p_image']['name'];
                                $tmp_name = $_FILES['p_image']['tmp_name'];
                                $allowed_extension = array('png','jpg','jpeg');
                                $file_extension = pathinfo($image,PATHINFO_EXTENSION);
                                if(!in_array($file_extension,$allowed_extension)){
                                    echo "<script>alert('Please Select png / jpg / jpeg format images')</script>";
                                }else{
                                    $path = "img/web_image/$category_id,$category_name/$name/$image";
                                    move_uploaded_file($tmp_name, $path);
                                    $cat_query = "UPDATE products SET image='$path' WHERE id = $id";
                                    $cat_result = mysqli_query($connection, $cat_query);
                                    if ($cat_result) {
                                        echo "<script>
                                            alert('Image Uploaded Successfully');
                                            window.location.href = 'products.php';
                                        </script>";
                                    }

                                }
                            }
                        ?>
                        <?php
                            // for fetching product data
                            $query = "SELECT * FROM products WHERE id = $id";
                            $result = mysqli_query($connection, $query);
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                $fetch_d = mysqli_fetch_assoc($result);
                            } else {
                                echo "<script>
                                    window.location.href = 'products.php';    
                                </script>";
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <!-- for Category Name -->
                                <label for="category">Select Product Category</label>
                                <select name="category" class="custom-select mb-3" id="category" required>
                                    <option hidden>Select Category</option>
                                    <?php
                                    $fetch_category_query = "SELECT * FROM categories";
                                    $fetch_category_result = mysqli_query($connection, $fetch_category_query);
                                    foreach ($fetch_category_result as $fetch) {
                                        if ($fetch['id'] == $fetch_d['categories_id']) {
                                            echo "<option selected value='$fetch[id]'>$fetch[categories]</option>";
                                        } else {
                                            echo "<option value='$fetch[id]'>$fetch[categories]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <!-- for Product Name -->
                                <label for="pname">Enter Product Name</label>
                                <input type="text" name="p_name" id="pname" value="<?php echo $fetch_d['name'] ?>" class="form-control mb-3" placeholder="Enter Product Name">
                                <!-- for Product MRP -->
                                <label for="mrp">Enter Product M.R.P</label>
                                <input type="number" name="p_mrp" id="mrp" value="<?php echo $fetch_d['mrp'] ?>" class="form-control mb-3" placeholder="Enter Product M.R.P">
                                <!-- for Product Price -->
                                <label for="price">Enter Product Price</label>
                                <input type="number" name="p_price" id="price" value="<?php echo $fetch_d['price'] ?>" class="form-control mb-3" placeholder="Enter Product Price">
                                <!-- for Product Qty -->
                                <label for="qty">Enter Product Quantity</label>
                                <input type="number" name="p_qty" id="qty" value="<?php echo $fetch_d['qty'] ?>" class="form-control mb-3" placeholder="Enter Product Qty">
                                <!-- for Product Short Desc -->
                                <label for="s_desc">Enter Product Short Description</label>
                                <input type="text" name="p_s_desc" id="s_desc" value="<?php echo $fetch_d['short_desc'] ?>" class="form-control mb-3" placeholder="Enter Product Short Description">
                                <!-- for Product Desc -->
                                <label for="desc">Enter Product Description</label>
                                <textarea name="p_desc" class="form-control mb-3" placeholder="Enter Product Description"><?php echo $fetch_d['description'] ?></textarea>
                                <!-- for Meta title -->
                                <label for="m_title">Enter Product Meta Title</label>
                                <input type="text" name="meta_title" id="m_title" value="<?php echo $fetch_d['meta_title'] ?>" class="form-control mb-3" placeholder="Enter Meta Title">
                                <!-- for Meta Description -->
                                <label for="m_desc">Enter Product Meta Description</label>
                                <input type="text" name="meta_desc" id="m_desc" value="<?php echo $fetch_d['meta_desc'] ?>" class="form-control mb-3" placeholder="Enter Meta Description">
                                <!-- for Meta keywords -->
                                <label for="m_keyword">Enter Product Meta Keyword</label>
                                <input type="text" name="meta_keyword" id="m_keyword" value="<?php echo $fetch_d['meta_keyword'] ?>" class="form-control mb-3" placeholder="Enter Meta Keyword">
                            </div>
                            <button type="submit" name="btn_update" class="btn btn-primary">Update Product</button>
                        </form>
                        <?php
                            // for insert data
                            if (isset($_POST['btn_update'])) {
                                $category = $_POST['category'];
                                $name = $_POST['p_name'];
                                $mrp = $_POST['p_mrp'];
                                $price = $_POST['p_price'];
                                $qty = $_POST['p_qty'];
                                $short_desc = $_POST['p_s_desc'];
                                $desc = $_POST['p_desc'];
                                $meta_title = $_POST['meta_title'];
                                $meta_desc = $_POST['meta_desc'];
                                $meta_keyword = $_POST['meta_keyword'];
                                $meta_desc = $_POST['meta_desc'];
                                $cat_query = "UPDATE products SET categories_id='$category',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$desc',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE id = $id";
                                $cat_result = mysqli_query($connection, $cat_query);
                                if ($cat_result) {
                                    echo "<script>
                                            alert('Product Updated Successfully');
                                            window.location.href = 'products.php';
                                        </script>";
                                }
                            }
                        ?>
                    </div>
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