<?php
    include("connection.php");
    $name = $_POST['p_name'];
    // Escaping user input to prevent SQL injection
    $escaped_name = mysqli_real_escape_string($connection, $name);
    $query = "SELECT products.*, products.id as p_id, products.status as p_status, categories.* 
    FROM products 
    INNER JOIN categories ON products.categories_id = categories.id 
    WHERE products.name LIKE '%$escaped_name%'";
    $result = mysqli_query($connection, $query);
    $num = mysqli_num_rows($result);
    $output = "";
    if($num > 0){
        foreach($result as $row){
            $output .= "
                <tr class='text-center align-middle'>
                <td class='align-middle'>{$row['p_id']}</td>
                <td class='align-middle'>{$row['name']}</td>
                <td><img src='{$row['image']}' width='150px' height='70px'/></td>
                <td class='align-middle'>{$row['categories']}</td>
                <td class='align-middle'>{$row['mrp']}</td>
                <td class='align-middle'>{$row['price']}</td>
                <td class='align-middle'>{$row['qty']}</td>
                <td class='align-middle'>";
            if ($row['p_status'] == 1) {
                $output .= "<a href='deactivate_products.php?id={$row['p_id']}'>
                                <button class='btn btn-danger btn-sm'>Deactivate</button>
                            </a>";
            } else {
                $output .= "<a href='activate_products.php?id={$row['p_id']}'>
                                <button class='btn btn-success btn-sm px-3'>Activate</button>
                            </a>";
            }
            $output .= "</td>
            <td class='align-middle'>
                <a href='delete_products.php?id={$row['p_id']}' onclick='return checking()'>
                    <button class='btn btn-danger px-2 btn-sm'>
                        Delete
                    </button>
                </a>
                <a href='edit_products.php?id={$row['p_id']}'>
                    <button class='btn btn-success px-3 btn-sm'>
                        Edit
                    </button>
                </a>
            </td>
            </tr>";
        }
        echo $output;
    } else {
        echo "<tr class='text-center'><td>Product Not Found</td></tr>";
    }
?>
