<?php
    session_start();
    unset($_SESSION["user"]);
    setcookie("email",' ',1,"/");
    setcookie("password",' ',1,"/");
    header("Location: ../login.php");

?>