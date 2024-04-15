<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE products SET status = 1 WHERE id=$id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "
        <script>
        alert('Activate Successfully')
        window.location.href = 'products.php'
        </script>
        ";
    }
?>