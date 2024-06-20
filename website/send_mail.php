<?php
    require("connection.php");
    require("mail_sender_func.php");
    session_start();
    $user_id = $_POST['u_id']; 
    $email = $_POST['u_email']; 
    $v_code = bin2hex(random_bytes(16));
    $update_previous_v_code = mysqli_query($connection, "UPDATE users SET verification_code = '$v_code' WHERE user_id = $user_id and user_email = '$email'");
    if ($update_previous_v_code) {
        mail_sender($email, $v_code);
    } else {
        // Handle database update failure
        echo "Failed to update verification code.";
    }
?>