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

public function insert_Admin($Name,$Mail,$Password,$Expiry,$active,$Companyname){
    try {
     $get = "Select * from admin where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into admin (Name,Mail,Password,Expiry,active,Companyname) values ('$Name','$Mail','$Password','$Expiry','$active','$Companyname') ";
    $result = mysqli_query($this->conn, $query);
    return "success";
    }else{
    return "userexist";
    }
    } catch (\Throwable $th) {
        throw $th;
    }
}
public function insert_Campaingn($Sendlink,$Campaingn,$Email){
      $query = "SELECT * FROM admin WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
        $userlength = count($Sendlink);
        $Campaingn_id = "";
        $Campaingn_name = $Campaingn->{'Campaingn'};
        $Campaingn_Type = $Campaingn->{'Type'};
        // $current_date = date('Y-m-d');  
         $que =  "SELECT * FROM campaingn ORDER BY createdate DESC limit 1";
         $res = mysqli_query($this->conn, $que);
         while ($row = $res->fetch_assoc()) {
            $Campaingn_id =  $row['id']+1;
         }
        if (mysqli_num_rows($result) == 1) {
            try {
                //code...
           
            $row = mysqli_fetch_assoc($result);
            $Admin_id = $row['id'];
            $insert = "insert into campaingn (id,No_of_Users,Campaingn_Name,Type,Admin_id) values ('$Campaingn_id','$userlength','$Campaingn_name','$Campaingn_Type ','$Admin_id') ";
            $final = mysqli_query($this->conn, $insert);

            foreach ($Sendlink as $send ) {   
            $userid = $send->{'User'};
            // $userName = $send->{'Name'};
            // $userMail = $send->{'Mail'};
            $ins = "insert into senddata (Campain_id,user_id) values ('$Campaingn_id','$userid') ";
            $fin = mysqli_query($this->conn, $ins);
             return "success";
            }
             } catch (\Throwable $th) {
                throw $th;
            }
             } else{
                return "not";
             }  
             
}


public function insert_User($Name,$User,$Mail,$Password,$Whatsapp,$Facebook,$Instagram,$isActive,$Adminid){
    try {
    $get = "Select * from users where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    $current_date = date('Y-m-d');
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into users (Name,User,Mail,Password,Whatsapp,Facebook,Instagram,isActive,admin_id,Expiry_video) values ('$Name','$User','$Mail','$Password','$Whatsapp','$Facebook','$Instagram','$isActive','$Adminid','$current_date') ";
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