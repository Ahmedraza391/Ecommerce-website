<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function mail_sender($email,$v_code){
                
        require("php_mailer/PHPMailer.php"); 
        require("php_mailer/SMTP.php"); 
        require("php_mailer/Exception.php");  
        $mail = new PHPMailer(true);

        try {                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '0312ahmedjutt@gmail.com';                     //SMTP username
            $mail->Password   = 'ovezkotppwuqloim';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('0312ahmedjutt@gmail.com', 'Jutt Collection');
            $mail->addAddress($email);
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification From Jutt Collection';
            $mail->Body    = "Thanks for Registration on Jutt Collection Click the link below to verify Email Address <br> <a href='http://localhost/projects/Ecommerce-website/website/verify.php?email=$email&v_code=$v_code'>Verify</a>";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
?>