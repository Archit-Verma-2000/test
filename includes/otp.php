<?php
      // print_r($_POST);
      $otp=$db->test_input($_POST["otp"]);
      $email=$db->test_input($_POST["email"]);
      $res=$db->verify_otp($otp,$email);
      // print_r($res);
      if($res==NULL)
      {
          $msg=["status"=>"failed","msg"=>$db->msg("danger","OTP is incorrect")];
          $json=json_encode($msg);
          echo $json;
      }
      else
      {
          if(isset($_POST["remember"]))
          {
            setcookie("emailRemember",$email,time()+60*60*24*30,"/");
          }
          $email=$db->otp_check_request($email);
          if($email==NULL)
          {   
              // echo "OTP expired";
              $msg=["status"=>"failed","msg"=>$db->msg("danger","OTP expired")];
              $json=json_encode($msg);
              echo $json;
          }
          else
          {
              $res=$email["email"];
              $_SESSION["user"]=$res;
              setcookie("email",$res,time()+60*60*24*30,"/");
              $msg=["status"=>"loggedIn","msg"=>$db->msg("success","loggedIn")];
              $json=json_encode($msg);
              echo $json;
          }
      }
?>