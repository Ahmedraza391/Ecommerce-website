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
                    <div class="content shadow p-md-5 p-3 mb-5 mx-2 bg-body-tertiary rounded">
                        <a href="categories.php" class="btn btn-primary my-3 font-weight-bolder">/ Back</a>
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                            <h1 class="h4 mb-0 text-gray-800 border-dark border-bottom font-weight-bold">Edit / Update Category</h1>
                        </div>
                        <?php 
                            $id = $_GET['id'];
                            $query = "SELECT * FROM categories WHERE id = $id ";
                            $result = mysqli_query($connection,$query);
                            $num = mysqli_num_rows($result);
                            if($num > 0){
                                $fetch = mysqli_fetch_assoc($result);
                            }else{
                                echo "<script>
                                    window.location.href = 'categories.php';    
                                </script>";
                            }
                        ?>
                        <?php 
                            if(isset($_POST['btn_update'])){
                                $id = $_GET['id'];
                                $cat_name = $_POST['cat_name'];
                                $cat_query = "UPDATE categories SET categories='$cat_name' WHERE id = $id";
                                $cat_result = mysqli_query($connection,$cat_query);
                                echo "<script>
                                        alert('Category Updated Successfully')
                                        window.location.href = 'categories.php';    
                                </script>";
                            }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" name="cat_name" value="<?php echo $fetch['categories'] ?>" class="form-control mb-3" placeholder="Enter Category Name">
                                <input type="text" readonly value="<?php if($fetch['status']==0){echo "Deactivate";}else{echo "Activate";} ?>" class="form-control">
                            </div>
                            <button type="submit" name="btn_update" class="btn btn-primary">Update Category</button>
                        </form>
                        
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