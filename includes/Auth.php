<?php
require "connection.php";
Class Auth extends Connection{
    private $req_count=0;
    public function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    public function user_exists($email)
    {
        $sql="SELECT email from db_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    /*-------Contact Form spam filter code-----------*/
    public function mail_user_add($name,$email){
        $res=$this->mail_user_exists($email);
        if($res==NULL)
        {
            $sql="INSERT INTO mail_subscribers(Name,email,createdAt) VALUES(:name,:email,NOW())";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["name"=>$name,"email"=>$email]);
        }
        $this->spam_logs($email);
    }

    public function mail_user_exists($email){
        $sql="SELECT email from mail_subscribers where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return($result);
    }

    public function spam_count($email){
        $sql="SELECT COUNT(*) as count  FROM spam_logs where email=:email AND submit_time > NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        $count=$res["count"];
        return($count);
       }
       public function banned_user($email)
       {
           $sql="SELECT email from banned_user where email=:email";
           $stmt=$this->conn->prepare($sql);
           $stmt->execute(["email"=>$email]);
           $result=$stmt->fetch(PDO::FETCH_ASSOC);
           return $result;
       }
   
    public function spam_logs($email){
        if($this->spam_count($email)<5)
        {
        $sql="INSERT INTO  spam_logs(email,submit_time) VALUES(:email,NOW())";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        }
        else
        {
            if($this->banned_user($email)==NULL)
            {
                
                    $sql="INSERT INTO  banned_user(email,createdAt) VALUES(:email,NOW())";
                    $stmt=$this->conn->prepare($sql);
                    $stmt->execute(["email"=>$email]);
            }
            else
            {
                $sql="SELECT email from banned_user where createdAt < NOW()-INTERVAL 24 HOUR  AND email=:email";
                $stmt=$this->conn->prepare($sql);
                $stmt->execute(["email"=>$email]);
                $result=$stmt->fetch(PDO::FETCH_ASSOC); 
                if($result!=NULL)
                {
                    $this->del_ban_user($result["email"]);
                    $this->del_ban_user_log($result["email"]);
                }
                return $result;
            }
        }
    }

    public function del_ban_user($email){
        $sql="DELETE FROM banned_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
    }
    public function del_ban_user_log($email){
        $sql="DELETE FROM spam_logs where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
    }
    public function User_ban_time($email){
        $sql="SELECT 24-TIMESTAMPDIFF(HOUR,createdAt,Now()) AS remaining_hours FROM banned_user WHERE email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        $time_left=$result["remaining_hours"];
        return($time_left);
    }
   /*-------Contact Form spam filter code ends-----------*/


    public function Register($fname,$lname,$email,$phone,$hash)
    { 
        $sql="INSERT INTO db_user(first_name,last_name,email,phone,password) VALUES(:fname,:lname,:email,:phone,:hash)";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["fname"=>$fname,"lname"=>$lname,"email"=>$email,"phone"=>$phone,"hash"=>$hash]);
        return true;
    }
    public function update_user_authenticated($email)
    {
        $sql="UPDATE db_user SET isAuthenticated=1 where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);  
    }
    public function check_user_authenticated($email)
    {
        $sql="SELECT email from db_user where email=:email AND isAuthenticated=1";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    // public function check_user_authenticate($email)
    // {
    //     $sql="SELECT email from db_user where isAuthenticated=1 and email=:email";
    //     $stmt=$this->conn->prepare($sql);
    //     $stmt->execute(["email"=>$email]);   
    // }
    public function LoginUser($email){
        $sql="SELECT first_name,last_name,email,password from db_user where email=:email AND deleted!=0";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function Login($email){
        $sql="SELECT * from db_user where email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function Update($id,$fname,$lname,$email,$phone){
        $sql="UPDATE db_user SET first_name=:fname,last_name=:lname,email=:email,phone=:phone where id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["fname"=>$fname,"lname"=>$lname,"email"=>$email,"phone"=>$phone,"id"=>$id]);
        $stmt->close();
        return(true);
    }
    public function email_otp_exists($email)
    {
        $sql="SELECT otp FROM otp_detail WHERE email=:email";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email]);
            $otp=$stmt->fetch(PDO::FETCH_ASSOC);
            return $otp;   
    }
    public function otp_create($email,$otp)
    {   if($this->email_otp_exists($email))
        {
            $sql="UPDATE otp_detail SET otp=:otp,createdAt=NOW() WHERE email=:email";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["email"=>$email,"otp"=>$otp]);
            return true;  
        }
        else
        {
        $sql="INSERT INTO otp_detail(email,otp,createdAt) VALUES(:email,:otp,NOW())";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email,"otp"=>$otp]);
        return true;
        }
    }
    public function verify_otp($otp,$email)
    {
        $sql="SELECT email from otp_detail where otp=:otp AND email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["otp"=>$otp,"email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function otp_check_request($email)
    {
        $sql="SELECT email from otp_detail where email=:email AND createdAt>=NOW()-INTERVAL 5 MINUTE";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["email"=>$email]);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    public function msg($type,$msg){
        $msg = '<div class="alert alert-' . $type . ' fade show">
        <button id="btn-success" class="btn btn-lg fs-5"  style="
    background-image: none;margin:0 20px 0 0;padding:0;color:rgba(0,0,0,0.6);display:inline-block;background-color:none;width:0;padding:0;
">&times;</button>
        <span><strong>' . $msg . '</strong></span>
    </div>';

        return $msg;
    }
}
$db=new Auth();
?>