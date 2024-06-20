<?php 
include("connection.php");
$value = $_POST['val'];
$data = "";
if($value=="l_high"){
    $query = mysqli_query($connection,"SELECT * FROM products ORDER BY price ");
    foreach ($query as $product) {
        $data .= "<div class='product_card'>";
            $data .= "<a href='product_details.php?id=$product[id]'>";
                $data .= "<div class='product_image'>";
                    $data .= "<img src='../admin-panel/$product[image]' alt=''>";
                $data .= "</div>";
                $data .= "<div class='product_body'>";
                    $data .= "<h5>$product[name]</h5>";
                    $data .= "<h6>Rs $product[price]/-</h6>";
                    $data .= "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                    if ($product['qty'] > 0) {
                        $data .= "<h6 class='text-success'>Instock</h6>";
                    } else {
                        $data .= "<h6 class='text-danger'>Out of Stock</h6>";
                    }
                $data .= "</div>";
            $data .= "</a>";
        $data .= "</div>";
        
    }
    echo $data;
}else if($value=="h_low"){
    $query = mysqli_query($connection,"SELECT * FROM products ORDER BY price DESC");
    foreach ($query as $product) {
        $data .= "<div class='product_card'>";
            $data .= "<a href='product_details.php?id=$product[id]'>";
                $data .= "<div class='product_image'>";
                    $data .= "<img src='../admin-panel/$product[image]' alt=''>";
                $data .= "</div>";
                $data .= "<div class='product_body'>";
                    $data .= "<h5>$product[name]</h5>";
                    $data .= "<h6>Rs $product[price]/-</h6>";
                    $data .= "<h6 class='strike_trough'>Rs $product[mrp]/-</h6>";
                    if ($product['qty'] > 0) {
                        $data .= "<h6 class='text-success'>Instock</h6>";
                    } else {
                        $data .= "<h6 class='text-danger'>Out of Stock</h6>";
                    }
                $data .= "</div>";
            $data .= "</a>";
        $data .= "</div>";
        
    }
    echo $data;
}else{
    $data = "Products Not Found";
    echo $data;
}
?>