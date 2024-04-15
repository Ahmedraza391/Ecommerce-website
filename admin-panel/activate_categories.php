<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE categories SET status =1 WHERE id=$id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "
        <script>
        alert('Activate Successfully')
        window.location.href = 'categories.php'
        </script>
        ";
    }
?>