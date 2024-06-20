<?php 
include("connection.php");
$val = $_POST['data'];
$query = "SELECT * FROM products WHERE name LIKE '%$val%'";
$execute = mysqli_query($connection,$query);
$data = "";
foreach ($execute as $product) {
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
?>