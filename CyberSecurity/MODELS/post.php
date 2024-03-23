<?php

include_once '../../../config/database.php';


class Post
{
    public $conn;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

public function insert_Admin($Name,$Mail,$Password,$Expiry,$active){
    try {
     $get = "Select * from admin where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into admin (Name,Mail,Password,Expiry,active) values ('$Name','$Mail','$Password','$Expiry','$active') ";
    $result = mysqli_query($this->conn, $query);
    return "success";
    }else{
    return "userexist";
    }
    } catch (\Throwable $th) {
        throw $th;
    }
}

public function insert_User($Name,$User,$Mail,$Password,$Whatsapp,$Facebook,$Instagram,$isActive){
    try {
     $get = "Select * from users where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into users (Name,User,Mail,Password,Whatsapp,Facebook,Instagram,isActive) values ('$Name','$User','$Mail','$Password','$Whatsapp','$Facebook','$Instagram',$isActive) ";
    $result = mysqli_query($this->conn, $query);
    return "success";
    }else{
    return "userexist";
    }
    } catch (\Throwable $th) {
        throw $th;
    }
}
}
?>