<?php

require "Auth.php";
if(!isset($_SESSION["user"]))
{
   header("Location: ../login.php"); 
}

$data=$db->Login($_SESSION["user"]);
// if($data==NULL)
// {
//     echo "null";
// }
// else
// {
//     echo "full";
// }
?>