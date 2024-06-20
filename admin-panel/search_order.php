<?php
    include("connection.php");
    $o_id = (isset($_POST['o_id']))?$_POST['o_id']:0;
    if($o_id>0){
        $query = "SELECT order_details.*, user_order.*,user_order.id as 'o_id', products.*,products.name as 'p_name' FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id INNER JOIN products ON order_details.product_id = products.id WHERE user_order.id = $_POST[o_id]";
        $result = mysqli_query($connection,$query);
        $num = mysqli_num_rows($result);
        $output = "";
        $ad = mysqli_query($connection,"SELECT * FROM user_order WHERE id = $_POST[o_id]");
        $ad_num = mysqli_num_rows($ad);
        if($ad_num > 0){
            foreach($result as $row){
                $output .= "
                <tr class='text-center align-middle'>
                    <td class='align-middle'>#{$row['o_id']}</td>
                    <td class='align-middle'>{$row['p_name']}</td>
                    <td><img src='{$row['image']}' width='150px' height='70px'/></td>
                    <td class='align-middle'>{$row['product_price']}</td>
                    <td class='align-middle'>{$row['address']}</td>
                    <td class='align-middle'>{$row['user_mobile']}</td>
                    <td class='align-middle'>{$row['payment_type']}</td>
                    <td class='align-middle'>{$row['order_status']}</td>
                    <td class='align-middle'>
                        <a href='update_order.php?id=$row[order_id]'>
                            <button class='btn btn-success px-3 btn-sm '>
                                Update Status
                            </button>
                        </a>
                    </td>
                </tr>";
            }
            echo $output;
        } else {
            echo "<tr class='text-center'><td colspan='9'>Product Not Found</td></tr>";
        }
    } else {
        // echo "<tr class='text-center'><td colspan='9'>Invalid Order ID</td></tr>";
        $query = "SELECT order_details.*, user_order.*,user_order.id as 'o_id', products.*,products.name as 'p_name' FROM order_details INNER JOIN user_order ON order_details.order_id = user_order.id INNER JOIN products ON order_details.product_id = products.id";
        $result = mysqli_query($connection,$query);
        $output = " ";
        foreach($result as $row){
            $output .= "
                <tr class='text-center align-middle'>
                    <td class='align-middle'>#{$row['o_id']}</td>
                    <td class='align-middle'>{$row['p_name']}</td>
                    <td><img src='{$row['image']}' width='150px' height='70px'/></td>
                    <td class='align-middle'>{$row['product_price']}</td>
                    <td class='align-middle'>{$row['address']}</td>
                    <td class='align-middle'>{$row['user_mobile']}</td>
                    <td class='align-middle'>{$row['payment_type']}</td>
                    <td class='align-middle'>{$row['order_status']}</td>
                    <td class='align-middle'>
                        <a href='update_order.php?id=$row[order_id]'>
                            <button class='btn btn-success px-3 btn-sm '>
                                Update Status
                            </button>
                        </a>
                    </td>
                </tr>";
        }
        echo $output;
    }
?>