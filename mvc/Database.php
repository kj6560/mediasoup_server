<?php
class Database
{
    public $con;
    public function __construct(){
        echo "reached here";
        require_once "configs.php";
        $host = $mysql_params['host'];
        $user = $mysql_params['username'];
        $pass = $mysql_params['password'];
        $db = $mysql_params['database'];
        $this->con = mysqli_connect($host, $user, $pass, $db);
        if($this->con){
            echo "connected";
        }
    }
    
}
