<?php
    include("connection.php");
    $name = $_POST['p_name'];
    $query = "SELECT * FROM products WHERE name = '$name'";
    $result = mysqli_query($connection,$query);
    $num = mysqli_num_rows($result);
    if($num){
        echo "<small class='text-danger'>This Product Name Already Exists<small>";
    }else{
        echo "<small class='text-success'>This Product Name Available<small>";
    }

?>