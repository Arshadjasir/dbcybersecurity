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
  public function SuperAdmin_Forgot($Email,$confirmpass){
     $query = "SELECT * FROM superadmin WHERE Mail='$Email'";
     $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $que = "UPDATE superadmin set Password = '$confirmpass' where Mail ='$Email'";
                if (mysqli_query($this->conn, $que)) {
                 return "Success";
                }else{
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
  public function Admin_Forgot($Email,$confirmpass){
    $query = "SELECT * FROM admin WHERE Mail='$Email'";
    $result = mysqli_query($this->conn, $query);
       if (mysqli_num_rows($result) == 1) {
           $row = mysqli_fetch_assoc($result);
           $que = "UPDATE admin set Password = '$confirmpass' where Mail ='$Email'";
               if (mysqli_query($this->conn, $que)) {
                return "Success";
               }else{
                 return "Decline";
               }
       } else {
           return 'Decline';
      }

 }

 public function Admin_Passchange($Mail,$old,$New){
  $query = "SELECT * FROM admin WHERE Mail='$Mail'";
     $result = mysqli_query($this->conn, $query);
     if (mysqli_num_rows($result) == 1) {
         $row = mysqli_fetch_assoc($result);
         $stored_password = $row['Password'];
         if ($old === $stored_password) {
             $query = "UPDATE admin set Password = '$New' where Mail ='$Mail'";
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

  /////////user

  public function user_Passchange($Mail,$old,$New){
    $query = "SELECT * FROM users WHERE Mail='$Mail'";
       $result = mysqli_query($this->conn, $query);
       if (mysqli_num_rows($result) == 1) {
           $row = mysqli_fetch_assoc($result);
           $stored_password = $row['Password'];
           if ($old === $stored_password) {
               $query = "UPDATE users set Password = '$New' where Mail ='$Mail'";
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

 public function user_Forgot($Email,$confirmpass){
  $query = "SELECT * FROM users WHERE Mail='$Email'";
  $result = mysqli_query($this->conn, $query);
     if (mysqli_num_rows($result) == 1) {
         $row = mysqli_fetch_assoc($result);
         $que = "UPDATE users set Password = '$confirmpass' where Mail ='$Email'";
             if (mysqli_query($this->conn, $que)) {
              return "Success";
             }else{
               return "Decline";
             }
     } else {
         return 'Decline';
    }

}

public function update_profile($mail,$whatsapp,$facebook,$instagram){
  $get = "Select * from users where Mail='$mail'";
  $getres = mysqli_query($this->conn, $get);
  while($row=mysqli_fetch_assoc($getres)){
    if($mail==$row['Mail']){
      $query = "UPDATE users set Mail='$mail',Whatsapp='$whatsapp', Facebook='$facebook',Instagram='$instagram' where Mail ='$mail'";
      $result=mysqli_query($this->conn, $query);
      return "Success";
    } 
    else{
      return "decline";
    }
  }
}

  
}
?>
