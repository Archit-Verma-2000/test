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
        echo $db->msg("danger","User exists");
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
                        echo "LoggedIn";
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
                            echo "errorrrrr";
                        } 
                    }
                }
                else
                {
                    $msg="otp-error+".$db->msg('danger', "User Not Authenticated");
                    echo $msg;
                }
            }
            else
            {
                $msg="otp-error+".$db->msg('danger', "Password doesnot match");
                echo $msg;
            }
        }
        else
        {
            $msg="otp-error+".$db->msg('danger', "User does not exists");
            echo $msg;
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
            // echo "OTP is incorrect";
            echo $db->msg("danger","OTP is incorrect");
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
                echo $db->msg("danger","OTP expired");
            }
            else
            {
                $res=$email["email"];
                $_SESSION["user"]=$res;
                setcookie("email",$res,time()+60*60*24*30,"/");
                echo "LoggedIn";
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
            echo $db->msg("danger","password doesnt match");
        }
        else
        {
            if($db->Update($id,$fname,$lname,$email,$phone))
            {
                $_SESSION["user"]=$email;
                setcookie("email",$email,time()+60*60*24*30,"/");
                $msg=$db->msg("success","successfully updated");
                $str="updated/$fname/$lname+$msg";
                echo $str;
            }
            else
            {
                echo $db->msg("danger","Oops something went wrong");  
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
                    echo msg("danger","email is banned for 24 hours");
                }
            }
            else
            {
                    echo "email send";
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
                    echo msg("danger","email is banned for 24 hours");
                }        
            }
            else
            {
                echo "email send";
                // require "contactmail.php";
            }
        }
    } 

?>