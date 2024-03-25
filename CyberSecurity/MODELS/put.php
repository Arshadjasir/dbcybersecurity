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


  public function SuperAdmin_Passchange($old,$New){
     $query = "SELECT * FROM superadmin WHERE Mail='superadmin@gmail.com'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];
            if ($old === $stored_password) {
                $query = "UPDATE superadmin set Password = '$New' where Mail ='superadmin@gmail.com'";
                if (mysqli_query($this->conn, $query)) {
                 return "Success";
                }
            } else {
                return "Decline";
            }
        } else {
            return 'Decline';
       }

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

<<<<<<< Updated upstream
=======
  public function admin_Change_Pass($id, $Name, $Mail, $oldPassword, $newPassword, $confirmPassword){
    
    $get = "SELECT * FROM users WHERE Password='$oldPassword'";
    $getres = mysqli_query($this->conn, $get);
    if(mysqli_num_rows($getres) ==1){ 
        if($newPassword === $confirmPassword){
            $query = "UPDATE users SET Name='$Name', Mail='$Mail', Password='$newPassword' WHERE password='$oldPassword'";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return "Success";
            } else {
                return "Error updating password";
            }
        } else {
            return "New password and confirm password do not match";
        }
    } else {
        return "Incorrect old password";
    }
}
>>>>>>> Stashed changes
}
?>
