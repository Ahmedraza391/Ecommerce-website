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
                                <a href="products.php">
                                    <button class="btn btn-primary font-weight-bolder"> / Back</button>
                                </a>
                                <div class="text-center d-flex justify-content-center my-3">
                                    <h2 class="text-dark border-bottom border-dark w-50 font-weight-bold">Add Products</h2>
                                </div>
                                <form method="POST" enctype="multipart/form-data">
                                    <select name="category" class="custom-select mb-3" required>
                                        <option hidden>Select Category</option>
                                        <?php
                                        $fetch_category_query = "SELECT * FROM categories";
                                        $fetch_category_result = mysqli_query($connection, $fetch_category_query);
                                        foreach ($fetch_category_result as $fetch) {
                                            echo "<option value='$fetch[id],$fetch[categories]'>$fetch[categories]</option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="p_name" placeholder="Enter Product Name" id="p_name" required>
                                        <p id="name_valid"></p>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="p_mrp" placeholder="Enter Product M.R.P" required>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="p_price" placeholder="Enter Product Price" required>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="p_qty" placeholder="Enter Product Quantity" required>
                                    </div>
                                    <div class="form-floating mb-3 custom-file">
                                        <input type="file" class="form-control custom-file-input" name="p_image" placeholder="Enter Product Quantity" id="inputGroupFile01" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file / Upload Product Image</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" name="p_short_desc" placeholder="Enter Short Description" required></textarea>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" name="p_desc" placeholder="Enter Long Description" required></textarea>
                                    </div>
                                    <div class="button my-2">
                                        <a href="categories.php">
                                            <button class="btn btn-success px-5" type="submit" name="btn_add">Add</button>
                                        </a>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['btn_add'])) {
                                    $category = $_POST['category'];
                                    $name = $_POST['p_name'];
                                    $img_name = $_FILES['p_image']['name'];
                                    $tmp_name = $_FILES['p_image']['tmp_name'];
                                    $type = $_FILES['p_image']['type'];
                                    $msg = $type;
                                    $allowed_extensions = array('jpg','png','jpeg');
                                    $file_extension = pathinfo($img_name , PATHINFO_EXTENSION);
                                    if(!in_array($file_extension , $allowed_extensions)){
                                        $msg = 'Please Select png / jpg / jpeg format images';
                                    }else{
                                        $folder = "img/web_image/$category/$name/";
                                        if(!file_exists($folder)){
                                            mkdir($folder,0777,true);
                                            $folder = "img/web_image/$category/$name/$img_name";
                                            move_uploaded_file($tmp_name,$folder);
                                        }
                                        $mrp = $_POST['p_mrp'];
                                        $price = $_POST['p_price'];
                                        $qty = $_POST['p_qty'];
                                        $short_desc = $_POST['p_short_desc'];
                                        $desc = $_POST['p_desc'];
                                        $query = "INSERT INTO products(name,categories_id,mrp,price,image,qty,short_desc,description,status)VALUES('$name','$category','$mrp','$price','$folder','$qty','$short_desc','$desc','1')";
                                        $result = mysqli_query($connection,$query);
                                        if($result){
                                            $msg = "Product Added Successfully";
                                        }
                                    }
                                }
                                ?>
                                <span class="text-success border-success border-bottom py-1 font-weight-bold"><?php if (isset($_POST['btn_add'])) { echo $msg;} ?></span>
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
<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on("focusout", "#p_name", function() {
            var name = $("#p_name").val();
            $.ajax({
                url: "check_name_product.php",
                type: "POST",
                data: {
                    p_name: name
                },
                success: function(data) {
                    $("#name_valid").html(data);
                    $("#name_valid") = "";
                }
            })
        })
    })
</script>
<!-- End of Content Wrapper -->
<?php include("bottom_page.php") ?>