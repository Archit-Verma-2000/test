<?php

    $name=$db->test_input($_POST["name"]);
    $email=$db->test_input($_POST["email"]);
    $subject=$db->test_input($_POST["subject"]);
    $msg=$db->test_input($_POST["message"]);
    if(isset($_POST["agreed"]))
    {
        $db->mail_user_add($name,$email);
        $result=$db->banned_user($email);
        if($result==NULL)
        {
            require "contactmail.php";
        }
        else
        {
            $time=$db->User_ban_time($email);
            $msg="User with email"." ".$email." "."Banned for"." ".$time."hrs";
            $arr=["status"=>"failed","msg"=>$db->msg('danger', $msg)];
            $res=json_encode($arr);
            echo $res;
        }
    }
    else
    {
        $db->spam_logs($email);
        $result=$db->banned_user($email);
        if($result==NULL)
        {
            require "contactmail.php";
        }
        else
        {
            $time=$db->User_ban_time($email);
            $msg=$email." "."Banned for"." ".$time."hrs";
            $arr=["status"=>"failed","msg"=>$db->msg('danger', $msg)];
            $res=json_encode($arr);
            echo $res;
        }
    }
       
?>