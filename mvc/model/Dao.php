<?php

class Dao extends Database {
    private $conn; 
    public function __construct() { 
       $dbcon = new parent(); 
       // this is not needed in your case
       // you can use $this->conn = $this->connect(); without calling parent()
       $this->conn = $dbcon->connect();
    }

    public function select( $table , $where='' , $other='' ){
       if($where != '' ){  // condition was wrong
         $where = 'where ' . $where; // Added space 
       }
       $sql = "SELECT * FROM  ".$table." " .$where. " " .$other;
       $sele = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
       // echo $sele; // don't use echo statement because - Object of class mysqli_result could not be converted to string
       return $sele;
    }
   }
?>