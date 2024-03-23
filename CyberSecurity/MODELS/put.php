<?php

include_once '../../../config/database.php';


class Put
{
  public $conn;

  function __construct()
  {
    $db = new Database();
    $this->conn = $db->connect();
  }


public function update_Admin($id,$Name,$Mail,$Password,$Expiry){
   $get = "Select * from admin where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    while ($row = mysqli_fetch_assoc($getresult)) {
      if($id==$row['id']){
         $query = "UPDATE admin set Name ='$Name', Mail ='$Mail',Password = '$Password', Expiry = '$Expiry' where id ='$id'";
          if (mysqli_query($this->conn, $query)) {
            return "Success";
          }
      }else{
        return "userexist";
     }
    }     
}
public function block_Admin($id){
   $queri = "UPDATE admin set active = 0 where id ='$id'";
          if (mysqli_query($this->conn, $queri)) {
            return "Success";
          }else{
            return "fail";
          }
}
public function unblock_Admin($id){
   $queri = "UPDATE admin set active = 1 where id ='$id'";
          if (mysqli_query($this->conn, $queri)) {
            return "Success";
          }else{
            return "fail";
          }
}
}
?>