<?php
     // print_r($_POST);
     $id=$db->test_input($_POST["id"]);
     $fname=$db->test_input($_POST["fname"]);
     $lname=$db->test_input($_POST["lname"]);
     $email=$db->test_input($_POST["email"]);
     $phone=$db->test_input($_POST["phone"]);
     $pass=$db->test_input($_POST["pass"]);
     $cpass=$db->test_input($_POST["cpass"]);
     if($pass!=$cpass)
     {
         // echo "yes";
         $msg=["status"=>"failed","msg"=>$db->msg("danger","password doesnt match")];
         $json=json_encode($msg);
         echo $json;
     }
     else
     {
         if($db->Update($id,$fname,$lname,$email,$phone))
         {
             $_SESSION["user"]=$email;
             setcookie("email",$email,time()+60*60*24*30,"/");
             $msg=["status"=>"success","msg"=>$db->msg("success","Updated successfully")];
             $json=json_encode($msg);
             echo $json;
         }
         else
         {
             $msg=["status"=>"failed","msg"=>$db->msg("danger","Oops something went wrong")];
             $json=json_encode($msg);
             echo $json;
         }
     }

?>