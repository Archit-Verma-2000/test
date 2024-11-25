<?php
    session_start();
    unset($_SESSION["user"]);
    setcookie("email",' ',1,"/");
    header("Location: ../login.php");

?>