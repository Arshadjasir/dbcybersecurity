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
<<<<<<< Updated upstream
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


  ///////////////////////// Admin ////////////////////////////////

  public function update_User($id,$Name,$User,$Mail,$Password,$Whatsapp,$Facebook,$Instagram){
    $get = "Select * from users where Mail='$Mail'";
    $getres = mysqli_query($this->conn, $get);
    while($row=mysqli_fetch_assoc($getres)){
      if($id==$row['id']){
        $query = "UPDATE users set Name='$Name', User='$User',Mail='$Mail',Password='$Password',Whatsapp='$Whatsapp',   Facebook='$Facebook',Instagram='$Instagram' where id ='$id'  ";
        $result=mysqli_query($this->conn, $query);
        return "Success";
      } 
      else{
        return "decline";
      }
    }
  }

  public function block_User($id){
    $queri = "UPDATE users set isActive = 0 where id ='$id'";
    if (mysqli_query($this->conn, $queri)) {
      return "Success";
    }else{
      return "fail";
    }
  }

  public function unblock_User($id){
    $queri = "UPDATE users set isActive = 1 where id ='$id'";
    if (mysqli_query($this->conn, $queri)) {
      return "Success";
    }else{
      return "fail";
    }
  }

}
?>
=======
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
public function Renew_Admin($id,$Expiry){

   $get = "Select * from admin where id='$id'";
    $getresult = mysqli_query($this->conn, $get);
    while($row=mysqli_fetch_assoc($getresult)){
     if($Expiry==$row['Expiry']){
           $new_expiry_date = date('Y-m-d', strtotime($Expiry . ' +1 year'));
           $queri = "UPDATE admin set Expiry = '$new_expiry_date' where id ='$id'";
           if (mysqli_query($this->conn, $queri)) {
            return "Success";
           }else{
            return "fail";
           }
     }
 
}}

public function update_User($Name,$User,$Mail,$Password,$Whatsapp,$Facebook,$Instagram,$id){
  try{
    $get = "Select * from users where Mail='$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    while($row=mysqli_fetch_assoc($getresult)){
     if($id==$row['id']){
      $query = "UPDATE users set Name='$Name', User='$User',Mail='$Mail',Password='$Password',Whatsapp='$Whatsapp',   Facebook='$Facebook',Instagram='$Instagram' where id ='$id'  ";
      if(mysqli_query($this->conn, $query)){
        return "Success";
      }
      else{
        return "userExist";
      }
     }
    }
  }catch (\Throwable $th) {
           return $th;
        }
}
}
?>
>>>>>>> Stashed changes
