<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();

Trait messages{
    public function flag1(){
        //register link success msg
        $type="success";
        $msg="Registeration link send to gmail id";
        $msg = '<div class="alert alert-' . $type . ' fade show">
        <button id="btn-success" class="btn btn-lg fs-5"  style="
    background-image: none;margin:0 20px 0 0;padding:0;color:rgba(0,0,0,0.6);display:inline-block;background-color:none;width:0;padding:0;
">&times;</button>
        <span><strong>' . $msg . '</strong></span>
    </div>';
        return $msg;
    }
    public function flag2(){    
        //Otp success msg
        $type="success";
        $msg="OTP send successfully";
        $msg = '<div class="alert alert-' . $type . ' fade show">
        <button id="btn-success" class="btn btn-lg fs-5"  style="
    background-image: none;margin:0 20px 0 0;padding:0;color:rgba(0,0,0,0.6);display:inline-block;background-color:none;width:0;padding:0;
">&times;</button>
        <span><strong>' . $msg . '</strong></span>
    </div>';
        return $msg;

    }
}
Class Connection {
    private $dsn;
    private $user;
    private $password;
    public $conn;

    public function __construct() {
        $this->dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'];
        $this->user = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    use messages;
}


?>