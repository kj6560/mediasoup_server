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
    $result = array();
    $query = "select * from users where id= ".$user_id;
    $data = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($data)){
        $result = $row;
    }
    return !empty($result)?$result:false;
}

function getConference($conn,$user,$conference_type){
    $result = array();
    if($conference_type==1){
        $query = "select * from conference where conference_type= ".$conference_type." and is_available=1 and (conference_by = ".$user['id']." or conference_for=".$user['id'].")";
    }else if($conference_type==2){
        $query = "select * from conference where conference_type= ".$conference_type." and is_available=1 and (conference_by = ".$user['id']." or conference_for in(".$user['id']."))";
    }
        
    $data = mysqli_query($conn,$query);
    while($row=mysqli_fetch_row($data)){
        $result = $row;
    }
    return !empty($result)?$result:false;
}

?>