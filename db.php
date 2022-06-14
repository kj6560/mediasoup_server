<?php 

function connect(){
    $host = "54.70.129.232";
    $username = "angeltalk";
    $password = "webrtc1@";
    $database = "angeltalk";
    $conn = mysqli_connect($host,$username,$password,$database);
    return $conn!=null?$conn:false;
}

function getUser($user_id,$conn){
    $query = "select * from users where id= ".$user_id;
    $data = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($data)){
        print_r($row);
    }
}


?>