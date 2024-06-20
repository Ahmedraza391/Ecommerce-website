<?php
    require("connection.php");
    echo $_GET['email'];
    echo $_GET['v_code'];
    $user = mysqli_query($connection,"SELECT * FROM users WHERE user_email = '$_GET[email]' and verification_code = '$_GET[v_code]'");
    if(mysqli_num_rows($user)>0){
        echo "hello";
        $fetch_user = mysqli_fetch_assoc($user);
        if($fetch_user['is_verified']==0){
            $update_user = mysqli_query($connection,"UPDATE users SET is_verified = 1 WHERE user_email = '$_GET[email]'");
            if($update_user){
                echo "<script>alert('Your Email Verified Successfully');window.location.href = 'checkout.php'</script>";
            }
        }else{
            echo "<script>alert('Your Email Already Verified');window.location.href = 'checkout.php';</script>";
        }
    }else{
        echo "<script>alert('Link Unmatched')</script>";
    }
?>