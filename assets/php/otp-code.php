<?php
    $otp=mt_rand(10000000,99999999);
    if($db->otp_create($email,$otp))
    {
  
        require "otpmail.php";
        $_SESSION["otp-email"]=$email;
    }
    else
    {
        echo "errorrrrr";
    }
?>