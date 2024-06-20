<?php
    include("connection.php");
    $query = "UPDATE tbl_slider SET status = 'hide' WHERE id = $_GET[id]";
    $run_query = mysqli_query($connection,$query);
    if($run_query){
        echo "<script>alert('Slide Hide Successfully');window.location.href='slider.php'</script>";
    }
?>