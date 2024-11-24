<?php
session_start();
require "Auth.php";
if(!isset($_SESSION["user"]))
{
   if(isset($_COOKIE["email"]))
   {
      $_SESSION["user"]=$_COOKIE["email"];
      header("Location:Admin/my-profile.php");
   }
   else
   {
      header("Location:login.php");
   }
}


// if($data==NULL)
// {
//     echo "null";
// }
// else
// {
//     echo "full";
// }
?>