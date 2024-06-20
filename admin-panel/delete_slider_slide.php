<?php
    include("connection.php");
    $query = mysqli_query($connection,"DELETE FROM tbl_slider WHERE id = $_GET[id]");
    if($query){
        echo "<script>alert('Slider Slide Deleted Successfully');window.location.href = 'slider.php'</script>";
    }
?>