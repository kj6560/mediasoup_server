<?php 
require "mvc/Database.php";
class Conference extends Database {
    public function __construct() { 
       parent::__construct();
    }

    public function select( ){
    //    if($where != '' ){  // condition was wrong
    //      $where = 'where ' . $where; // Added space 
    //    }
    //    $sql = "SELECT * FROM  ".$table." " .$where. " " .$other;
    //    $sele = mysqli_query($this->con, $sql) or die(mysqli_error($this->conn));
    //    // echo $sele; // don't use echo statement because - Object of class mysqli_result could not be converted to string
    //    return $sele;
    echo "reached here";
    }
   }
