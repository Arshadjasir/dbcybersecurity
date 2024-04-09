<?php
include_once '../../../config/database.php';

class Get
{
    public $conn;
    public $response;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }
 
     public function Superadmin_login($Mail,$Password){
         
        $query = "SELECT * FROM superadmin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['Password'];
        if ($Password === $stored_password) {
                return "Success";
            } else {
                return "Decline";
            }
        }else {
                return "Decline";
            }
        }


    public function Superadmin_otp($otp){
        $string = $otp;
        $query = "SELECT * FROM superadmin WHERE otp = '$string'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $otpTime = strtotime($row['time']);
            $currentTime = strtotime("now");
            $fiveMinutesLater = strtotime("+5 minutes", $otpTime); 
    
            if ($currentTime <= $fiveMinutesLater) {
                return "Success"; 
            } else {
                return "Decline"; 
            }
        } else {
            return "Decline"; 
        }
     }


   public function Superadmin_Mail_View($Mail){
        $query = "SELECT * FROM superadmin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
     if (mysqli_num_rows($result) == 1) {
             $row = mysqli_fetch_assoc($result);
             $Mail=$row['Mail'];
             $password = $row['Password'];
             $val = ["Mail" => $Mail, "Password" => $password];
             return $val;
      }
   }

    public function select_Admin(){
        $query = "SELECT * FROM admin ";
        $current_date = date('Y-m-d');

        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['active']!=0){
                if($row['Expiry']>$current_date){
                  $temp[] = $row;
                }
            }
        }
        return $temp;
    }

   
   public function Campaign_id(){
     $query =  "SELECT * FROM campaingn ORDER BY createdate DESC limit 1";
      $result = mysqli_query($this->conn, $query);
        while ($row = $result->fetch_assoc()) {
            return $row['id']+1;
        }
    
   }
   public function getuser_id(){
     $query =  "SELECT * FROM users ORDER BY Creation_Date DESC limit 1";
      $result = mysqli_query($this->conn, $query);
        while ($row = $result->fetch_assoc()) {
            return $row['id']+1;
        }
    
   }
   public function  select_Recent_Campaign($Mail){
    $que = "SELECT * FROM admin WHERE Mail='$Mail'";
    $res = mysqli_query($this->conn, $que);
    $Admin_id = "";  
    if (mysqli_num_rows($res) == 1) {
     $rows = mysqli_fetch_assoc($res);
     $Admin_id = $rows['id'];
    }
    $query = "SELECT * FROM campaingn WHERE Admin_id = '$Admin_id' ORDER BY createdate DESC LIMIT 2";
    $result = mysqli_query($this->conn, $query);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;

   }
   public function  select_All_Recent_Campaign(){
    $query = "SELECT * FROM campaingn ORDER BY createdate DESC LIMIT 2";
    $result = mysqli_query($this->conn, $query);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
   }
  
   public function Campaingn_Report($Mail){
    $que = "SELECT * FROM admin WHERE Mail='$Mail'";
    $res = mysqli_query($this->conn, $que);
    $Admin_idd = "";  
    if (mysqli_num_rows($res) == 1) {
        $rows = mysqli_fetch_assoc($res);
        $Admin_idd = $rows['id'];
    }
    $query = "SELECT campaingn.id, campaingn.No_of_Users, campaingn.Campaingn_Name, campaingn.Type, campaingn.createdate, admin.Name 
              FROM campaingn 
              JOIN admin ON campaingn.Admin_id = admin.id 
              WHERE campaingn.Admin_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $Admin_idd);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $temp = array();
    while ($row = $result->fetch_assoc()){
        $temp[] = $row;
    }

    return $temp;
}

    public function Report_Datas($cam_id){
       $query = "SELECT * FROM senddata WHERE Campain_id = '$cam_id'";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        if (!$result) {
              echo "Error: " . mysqli_error($this->conn);
        } else {
             while ($row = $result->fetch_assoc()) {
               $user_id = $row['user_id'];
                $user_query = "SELECT users.Name, users.User, users.Mail, users.Whatsapp, users.Facebook, users.Instagram, senddata.Click 
                       FROM users 
                       JOIN senddata ON users.User = senddata.user_id 
                       WHERE users.User = '$user_id' AND senddata.Campain_id = '$cam_id'";

                 $user_result = mysqli_query($this->conn, $user_query);

        if (!$user_result) {
            echo "Error: " . mysqli_error($this->conn);
        } else {
            while ($user_row = $user_result->fetch_assoc()) {
                $temp[] = $user_row;
            }
        }
    }
}
return $temp;

    }
   
    public function Users_Details(){
        $query = "SELECT users.id,users.Name,users.User,users.Mail,users.Whatsapp,users.Facebook,users.Instagram,users.isActive,users.Expiry_video,admin.Name,admin.Companyname FROM users JOIN admin ON users.admin_id = admin.id ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
                  $temp[] = $row;
        }
        return $temp;
    }
    

    public function blocked_Admin(){
        $query = "SELECT * FROM admin ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['active']!=1){
            $temp[] = $row;
            }
        }
        return $temp;
    }

    public function Expired_Admin(){
        $query = "SELECT * FROM admin";
        $current_date = date('Y-m-d');
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['Expiry']<$current_date){
            $temp[] = $row;
            }
        }
        return $temp;
    }

    public function Recent_Admin(){
      $query =  "SELECT * FROM admin ORDER BY createdate DESC limit 3";
      $result = mysqli_query($this->conn, $query);
         $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['active']!=0){
            $temp[] = $row;
            }
        }
        return $temp;
    }

    public function select_User($Mail){
         $query = "SELECT * FROM admin WHERE Mail='$Mail'";
         $result = mysqli_query($this->conn, $query);  
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $adminid = $row['id'];
                $userquery = "SELECT * from users";
                $res = mysqli_query($this->conn, $userquery);
                $temp = array();
                while ($userrow = $res->fetch_assoc()) {
                  if($userrow['isActive']!=0){
                    if($userrow['admin_id']==$adminid){
                      $temp[] = $userrow;
                    }
                  }
                }
         return $temp;
        }

    //   $adminquery = "SELECT * FROM admin WHERE Mail='$Mail";
    //   $res = mysqli_query($this->conn, $adminquery);
    //     if (mysqli_num_rows($res) == 1) {
    //         return true;
    //     }
        //   $adminrow = mysqli_fetch_assoc($res);
        //   $adminid=$adminrow['id'];
        //   $query = "SELECT * from users";
        //   $result = mysqli_query($this->conn, $query);
        //   $temp = array();
        //   while ($row = $result->fetch_assoc()) {
        //       if($row['isActive']!=0){
        //         if($row['id']==$adminid)
        //          $temp[] = $row;
        //       }
        //     }
        //     return $temp;
        
    }
   
 public function select_User_Name($Mail){
         $query = "SELECT * FROM admin WHERE Mail='$Mail'";
         $result = mysqli_query($this->conn, $query);  
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $adminid = $row['id'];
                $userquery = "SELECT * from users";
                $res = mysqli_query($this->conn, $userquery);
                $temp = array();
                while ($userrow = $res->fetch_assoc()) {
                  if($userrow['isActive']!=0){
                    if($userrow['admin_id']==$adminid){
                      $temp[] = $userrow['Name'];
                    }
                  }
                }
         return $temp;
        }
    }
    public function Select_Recent_User($Mail){
        $que = "SELECT * FROM admin WHERE Mail='$Mail'";
        $res = mysqli_query($this->conn, $que);
         $Admin_id = "";  
         if (mysqli_num_rows($res) == 1) {
          $rows = mysqli_fetch_assoc($res);
          $Admin_id = $rows['id'];
         }
         $query = "SELECT * FROM users WHERE admin_id = '$Admin_id' ORDER BY Creation_Date DESC LIMIT 3";
         $result = mysqli_query($this->conn, $query);
         $temp = array();
         while ($row = $result->fetch_assoc()) {
             $temp[] = $row;
          }
        return $temp;

    }
        
    public function Select_Total_Count(){
        // user
        $query1 = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query1);
        $User = mysqli_num_rows($result);
        // admin
        $query2 = "SELECT * FROM admin";
        $result = mysqli_query($this->conn, $query2);
        $Admin = mysqli_num_rows($result);
        $current_date = date('Y-m-d');
        $query3 = "SELECT * FROM admin WHERE Expiry_video > '$current_date'";
        $result1 = mysqli_query($this->conn, $query3);
        $query4 = "SELECT * FROM users WHERE Expiry_video > '$current_date'";
        $result2 = mysqli_query($this->conn, $query4);

        $Share_Temp = mysqli_num_rows($result1)+mysqli_num_rows($result2);

        $val = ["Admins" => $Admin, "Users" => $User,"Shared" =>$Share_Temp];
        return  $val ;
    }
     public function Select_countfor_admin($Mail){
         $query = "SELECT * FROM admin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        $Admin_id = "";  
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $Admin_id = $row['id'];
        }
        $query1 = "SELECT * FROM users Where admin_id= $Admin_id ";
        $result = mysqli_query($this->conn, $query1);
        $User = mysqli_num_rows($result);

        $query2 = "SELECT * FROM campaingn Where Admin_id= $Admin_id ";
        $result1 = mysqli_query($this->conn, $query2);
        $campaign = mysqli_num_rows($result1);

        $val = ["campaign" => $campaign, "Users" => $User];
        return $val;
    
    }


    public function blocked_User(){
        $query = "SELECT * FROM users ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['isActive']!=1){
            $temp[] = $row;
            }
        }
        return $temp;
    }

    public function admin_Login($Mail,$Password){
        $query = "SELECT * FROM admin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        $current_date = date('Y-m-d');  
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];
            $Expiry = $row['Expiry'];
            $Block = $row['active'];
            if($row['Expiry']>$current_date){
               if($Block!=0){
               if ($Password === $stored_password) {
                  return "Success";
                } else {
                  return "Decline";
                }
               }else{
                  return "Blocked";
               }
            }
            else{
                return "Expired";
            }
        } else {
            return 'Decline';
        }
    }
  
      public function Admin_otp($otp){
        $string = $otp;
        $query = "SELECT * FROM admin WHERE otp = '$string'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $otpTime = strtotime($row['time']);
            $currentTime = strtotime("now");
            $fiveMinutesLater = strtotime("+5 minutes", $otpTime); 
    
            if ($currentTime <= $fiveMinutesLater) {
                return "Success"; 
            } else {
                return "Decline"; 
            }
        } else {
            return "Decline"; 
        }

     }

    public function Admin_Mail_View($Email){
        $query = "SELECT * FROM admin WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
       if (mysqli_num_rows($result) == 1) {
             $row = mysqli_fetch_assoc($result);
             $mail=$row['Mail'];
             $password = $row['Password'];
             $val = ["Mail" => $mail, "Password" => $password];
             return $val;
      }
   }

    public function Admin_company($Email){
        $query = "SELECT * FROM admin WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
       if (mysqli_num_rows($result) == 1) {
             $row = mysqli_fetch_assoc($result);
             $companyname=$row['Companyname'];
             $Adminid=$row['id'];
             $val = ["Companyname" => $companyname, "id" => $Adminid];
             return $val;
      }else{
        return "no data";
      }
   }

   public function Admin_Select_Videos($Mail){
      
        $query = "SELECT * FROM admin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        $current_date = date('Y-m-d'); 
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $Expiry = $row['Expiry_video'];
            if($row['Expiry_video']>$current_date){
                  $sql = "SELECT * FROM videos";
                  $res = mysqli_query($this->conn, $sql); 
                  if ($res->num_rows > 0) {
                       $videos = array();
                          while($row = $res->fetch_assoc()) {
                              $videos[] = $row;
                          }
                         return $videos; 
                  }
             }else {
               $sql = "SELECT * FROM videos";
               $res = mysqli_query($this->conn, $sql);
               $videos = array();
                 if ($res) {
                     while ($row = $res->fetch_assoc()) {
                     $session = $row['session'];
                     $query = "SELECT ";
                     $query .= ($session == 1) ? "*" : "poster, session";
                     $query .= " FROM videos WHERE session = $session";
                     $result = mysqli_query($this->conn, $query);
        
                     if ($result) {
                         while ($rows = $result->fetch_assoc()) {
                         $videos[] = $rows;
                     }
                     } else {
                     echo "Error executing inner query: " . mysqli_error($this->conn);
                    }
                 }
                 } else {
                 echo "Error executing outer query: " . mysqli_error($this->conn);
                }

                 return $videos;
             }
      }
    
    }
    
    //////////////// user

    public function user_login($Mail,$Password){
        $query = "SELECT * FROM users WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];
            $Block = $row['isActive'];
            if($Block!=0){
                if ($Password === $stored_password) {
                    return "Success";
                 } else {
                     return "Decline";
                 }
            }else {
                     return "Blocked";
                 }
        } 
        else {
            return 'Decline';
        }
    }


      public function user_otp($otp){
        $string = $otp;
        $query = "SELECT * FROM users WHERE otp = '$string'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $otpTime = strtotime($row['time']);
            $currentTime = strtotime("now");
            $fiveMinutesLater = strtotime("+5 minutes", $otpTime); 
    
            if ($currentTime <= $fiveMinutesLater) {
                return "Success"; 
            } else {
                return "Decline"; 
            }
        } else {
            return "Decline"; 
        }
     }
     
    public function user_Mail_View($Email){
        $query = "SELECT * FROM users WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $mail=$row['Mail'];
            $password = $row['Password'];
            $val = ["Mail" => $mail, "Password" => $password];
            return $val;
        }
    }

    public function user_profile($Email){
        $query = "SELECT * FROM users WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $mail=$row['Mail'];
            $password = $row['Password'];
            $instagram = $row['Instagram'];
            $facebook = $row['Facebook'];
            $whatsapp = $row['Whatsapp'];
            $Name = $row['Name'];
            $val = ["Name"=>$Name,"Mail" => $mail, "Password" => $password,"Whatsapp" => $whatsapp,"Facebook" => $facebook,"Instagram" => $instagram];
            return $val;
        }
    }

    public function Select_videos($Mail){
        $query = "SELECT * FROM users WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        $current_date = date('Y-m-d'); 
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $Expiry = $row['Expiry_video'];
            if($row['Expiry_video']>$current_date){
                  $sql = "SELECT * FROM videos";
                  $res = mysqli_query($this->conn, $sql); 
                  if ($res->num_rows > 0) {
                       $videos = array();
                          while($row = $res->fetch_assoc()) {
                              $videos[] = $row;
                          }
                         return $videos; 
                  }
             }else {
               $sql = "SELECT * FROM videos";
               $res = mysqli_query($this->conn, $sql);
               $videos = array();
                 if ($res) {
                     while ($row = $res->fetch_assoc()) {
                     $session = $row['session'];
                     $query = "SELECT ";
                     $query .= ($session == 1) ? "*" : "poster, session";
                     $query .= " FROM videos WHERE session = $session";
                     $result = mysqli_query($this->conn, $query);
        
                     if ($result) {
                         while ($rows = $result->fetch_assoc()) {
                         $videos[] = $rows;
                     }
                     } else {
                     echo "Error executing inner query: " . mysqli_error($this->conn);
                    }
                 }
                 } else {
                 echo "Error executing outer query: " . mysqli_error($this->conn);
                }

                 return $videos;
             }
      }
    }

}
?>