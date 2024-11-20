<?php
    session_start();
    require "Auth.php";
    require __DIR__ . '/../../vendor/autoload.php';
    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
    if(isset($_POST["action"])&&$_POST["action"]=="Register")
    {
        // print_r($_POST);
       $fname=$db->test_input($_POST["fname"]);
       $lname=$db->test_input($_POST["lname"]);
       $email=$db->test_input($_POST["email"]);
       $phone=$db->test_input($_POST["phone"]);
       $password=$db->test_input($_POST["pass"]);
       $hash=password_hash($password,PASSWORD_DEFAULT);
       $userexist=$db->user_exists($fname,$lname,$email);
       if($userexist!=NULL)
       {
            $msg=["status"=>"failed","msg"=>$db->msg("danger","User exists")];
            $json=json_encode($msg);
            echo $json;
       }
       else
       {
            $db->Register($fname,$lname,$email,$phone,$hash);
            require "registermail.php";         
       }
    }
    else if(isset($_GET["action"])&&$_GET["action"]=="registerlink")
    {   
            $email=$_GET["email"];
            $db->update_user_authenticated($email);
    }
    else if(isset($_POST["action"])&($_POST["action"]=="Login"))
    {

        // print_r($_POST);
       
        $email=$db->test_input($_POST["email"]);
        $password=$db->test_input($_POST["password"]);
        if($LoggedUser=$db->LoginUser($email)){

            if(password_verify($password,$LoggedUser["password"]))//password verify
            {   $result=$db->check_user_authenticated($email);//isAuthenticated=0 initially it should be 1 returns null if not 1
                if($result!=NULL)
                {
                    if(isset($_COOKIE["emailRemember"])&&$email==$_COOKIE["emailRemember"])
                    {
                        $res=$email;
                        $_SESSION["user"]=$res;
                        setcookie("email",$res,time()+60*60*24*30,"/");
                        $msg=["status"=>"success","msg"=>$db->msg("success","Successfully logged in")];
                        $json=json_encode($msg);
                        echo $json;
                    }
                    else
                    {
                        $otp=mt_rand(10000000,99999999);//otp creation
                        if($db->otp_create($email,$otp))//otp send
                        {
                            
                            require "otpmail.php";
                        }
                        else
                        {
                            $msg=["status"=>"failed","msg"=>$db->msg("danger","OTP not send")];
                            $json=json_encode($msg);
                            echo $json;
                        } 
                    }
                }
                else
                {
                    $msg=["status"=>"failed","msg"=>$db->msg("danger","User Not Authenticated")];
                    $json=json_encode($msg);
                    echo $json;
                }
            }
            else
            {
                    $msg=["status"=>"failed","msg"=>$db->msg("danger","Password doesnot match")];
                    $json=json_encode($msg);
                    echo $json;
            }
        }
        else
        {
            $msg=["status"=>"failed","msg"=>$db->msg("danger","User does not exists")];
            $json=json_encode($msg);
            echo $json;
        }
   
    }
    else if(isset($_POST["action"])&&$_POST["action"]=="otp")
    {
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
    }
    else if(isset($_POST["action"])&&$_POST["action"]=="update")
    {
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
                $msg=["status"=>"success","msg"=>$db->msg("sucess","successfully updated")];
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
    }
   
    else if (isset($_POST["action"]) && $_POST["action"] == "Contact") {
        

        // Load Composer's autoloader
        require 'vendor/autoload.php';
        $mail = new PHPMailer(true);
        // Sanitize inputs
        $name = $db->test_input($_POST["name"]);
        $email = $db->test_input($_POST["email"]);
        $subject = $db->test_input($_POST["subject"]);
        $msg = $db->test_input($_POST["message"]);
       
        
        if(isset($_POST["agreed"]))
        {
            $db->mail_user_add($name,$email);
            $count=$db->spam_count($email);
            if($count>5)
            {
                // echo "email banned"; 
                $result=$db->spam_logs($email);
                if($result==NULL)
                {
                    $msg=["status"=>"failed","msg"=>$db->msg("danger","email is banned for 24 hours")];
                    $json=json_encode($msg);
                    echo $json;
                }
            }
            else
            {
                    //  require "contactmail.php";
            }
        }
        else
        {   $db->spam_logs($email);
            $count=$db->spam_count($email);
            if($count>5)
            {
                $result=$db->spam_logs($email);
                // echo "email banned"; 
                if($result==NULL)
                {
                    $msg=["status"=>"failed","msg"=>$db->msg("danger","email is banned for 24 hours")];
                    $json=json_encode($msg);
                    echo $json;
                }        
            }
            else
            {
                $msg=["status"=>"success","msg"=>$db->msg("danger","email send")];
                $json=json_encode($msg);
                echo $json;
                // require "contactmail.php";
            }
        }
    } 

?>