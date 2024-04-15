<?php
    include("connection.php");
    $query = "DELETE FROM categories WHERE id = '$_GET[id]'";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "
        <script>
        alert('Deleted Successfully')
        window.location.href = 'categories.php'
        </script>
        ";
    }
?>