<?php
include("connection.php");
$id = $_GET['id'];
$query = "DELETE FROM products WHERE id = $id;";
$result = mysqli_query($connection,$query);
if($result){
    echo "<script>alert('Deleted Successfully');window.location.href = 'products.php'</script>";
}

?>