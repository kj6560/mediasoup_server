<?php
class Database
{
    protected $con;
    public function __construct(){
        $host = $mysql_params['host'];
        $user = $mysql_params['username'];
        $pass = $mysql_params['password'];
        $db = $mysql_params['database'];
        $this->con = mysqli_connect($host, $user, $pass, $db);
    }
    
}
