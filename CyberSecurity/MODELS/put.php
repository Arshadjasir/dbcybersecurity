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

  public function SuperAdmin_Passchange($Mail,$old,$New){
     $query = "SELECT * FROM superadmin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];
            if ($old === $stored_password) {
                $query = "UPDATE superadmin set Password = '$New' where Mail ='$Mail'";
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

  public function SuperAdmin_forgot_pass($Mail){
    $current_time = date("H:i:s");
    $otp = mt_rand(100000, 999999);
    $query = "UPDATE superadmin SET otp='$otp', time='$current_time' WHERE Mail='$Mail'";
    $result = mysqli_query($this->conn, $query);
    
    if ($result) {
      // $mailed = mail($Mail, "Your One-Time Password from Vebbox Software Solution", "Your OTP is: $otp");  
    // if ($mailed) {
    //   return true;
    // } else {
    //   return false;
    // }
    return "Success";
    } else {
      return "Decline";
   }
}

 public function Renew_Admin_Videos($id,$Expiry){
    
      $get = "Select * from admin where id='$id'";
      $getresult = mysqli_query($this->conn, $get);
        while($row=mysqli_fetch_assoc($getresult)){
          
           if($Expiry==$row['Expiry_video']){
             $current_date = date('Y-m-d');
             if($current_date<=$Expiry){

                 $new_expiry_date = date('Y-m-d', strtotime($Expiry . ' +1 year'));
                 $queri = "UPDATE admin set Expiry_video = '$new_expiry_date' where id ='$id'";
                    if (mysqli_query($this->conn, $queri)) {
                         return "Success";
                    }else{
                         return "fail";
                    }
               }else{
                 $new_expiry_date = date('Y-m-d', strtotime($current_date . ' +1 year'));
                 $queri = "UPDATE admin set Expiry_video = '$new_expiry_date' where id ='$id'";
                    if (mysqli_query($this->conn, $queri)) {
                         return "Success";
                    }else{
                         return "faill";
                     }
              }
            }
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

  public function update_Admin($id,$Name,$Mail,$Password,$Expiry,$Companyname){
    $get = "Select * from admin where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    while ($row = mysqli_fetch_assoc($getresult)) {
      if($id==$row['id']){
        $query = "UPDATE admin set Name ='$Name', Mail ='$Mail',Password = '$Password', Expiry = '$Expiry',Companyname = '$Companyname' where id ='$id'";
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

   public function Renew_User($id,$Expiry){
    
      $get = "Select * from users where id='$id'";
      $getresult = mysqli_query($this->conn, $get);
        while($row=mysqli_fetch_assoc($getresult)){
          
           if($Expiry==$row['Expiry_video']){
             $current_date = date('Y-m-d');
             if($current_date<=$Expiry){

                 $new_expiry_date = date('Y-m-d', strtotime($Expiry . ' +1 year'));
                 $queri = "UPDATE users set Expiry_video = '$new_expiry_date' where id ='$id'";
                    if (mysqli_query($this->conn, $queri)) {
                         return "Success";
                    }else{
                         return "fail";
                    }
               }else{
                 $new_expiry_date = date('Y-m-d', strtotime($current_date . ' +1 year'));
                 $queri = "UPDATE users set Expiry_video = '$new_expiry_date' where id ='$id'";
                    if (mysqli_query($this->conn, $queri)) {
                         return "Success";
                    }else{
                         return "faill";
                     }
              }
            }
          }
        }
      


  ///////////////////////// Admin ////////////////////////////////
  public function Admin_forgot_pass($Mail){
    $current_time = date("H:i:s");
    $otp = mt_rand(100000, 999999);
    $query = "UPDATE admin SET otp='$otp', time='$current_time' WHERE Mail='$Mail'";
    $result = mysqli_query($this->conn, $query);
    
    if ($result) {
      // $mailed = mail($Mail, "Your One-Time Password from Vebbox Software Solution", "Your OTP is: $otp");  
    // if ($mailed) {
    //   return true;
    // } else {
    //   return false;
    // }
    return "Success";
    } else {
      return "Decline";
   }
}

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
        $query = "UPDATE users set Name='$Name', User='$User',Mail='$Mail',Password='$Password',Whatsapp='$Whatsapp',Facebook='$Facebook',Instagram='$Instagram' where id ='$id'  ";
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

  public function Admin_update_otp($Mail) {
    $current_time = date("H:i:s");
    $otp = mt_rand(100000, 999999);

    // $select = "SELECT * FROM admin LIMIT 1"; 
    // $selectQuery = mysqli_query($this->conn, $select);
    // $row = mysqli_fetch_assoc($selectQuery);
    // $email = $row['Email'];

    $query = "UPDATE admin SET otp='$otp', time='$current_time' WHERE Mail='$Mail'";
    $result = mysqli_query($this->conn, $query);
    
    if ($result) {
        $mailed = mail($email, "Your One-Time Password from Vebbox Software Solution", "Your OTP is: $otp");
        if ($mailed) {
            return "Success";
        } else {
          return "Decline";
        }
    } else {
        return false;
    }
}

 public function clicked_user($userid,$camid){
    $query = "select * from senddata where user_id ='$userid'";
     $result = mysqli_query($this->conn, $query);
     $temp = array();
      while ($row = $result->fetch_assoc()){
         $campaign_id = $row['Campain_id'];
         $user_id =  $row['user_id'];
         $temp[] = $row['user_id'];
        if ($camid == $campaign_id) {
              $que = "UPDATE senddata set Click = 1 where Campain_id ='$camid' AND user_id ='$userid'";
              if (mysqli_query($this->conn, $que)) {
                return "Success";
               }else{
                return "decline";
               }     
        }
      }
         return $temp;
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

public function user_forgot_pass($Mail){
  $current_time = date("H:i:s");
  $otp = mt_rand(100000, 999999);
  $query = "UPDATE users SET otp='$otp', time='$current_time' WHERE Mail='$Mail'";
  $result = mysqli_query($this->conn, $query);
  
  if ($result) {
    // $mailed = mail($Mail, "Your One-Time Password from Vebbox Software Solution", "Your OTP is: $otp");  
  // if ($mailed) {
  //   return true;
  // } else {
  //   return false;
  // }
  return "Success";
  } else {
    return "Decline";
 }
}

}


?>
