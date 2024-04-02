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
    public function Superadmin_forgot_pass($Mail){
        $query = "SELECT * FROM superadmin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
         if (mysqli_num_rows($result) == 1) {
            return "Success";
         }else{
            return "Decline";
         }
     }

    public function Superadmin_otp($otp){
        $Myotp = 123456;
        if($otp==$Myotp){   
            return "Success";
        }else{
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
             $val = ["Mail" => $mail, "Password" => $password];
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

    public function select_User(){
        $query = "SELECT * FROM users ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            if($row['isActive']!=0){
            $temp[] = $row;
            }
        }
        return $temp;
    }
   

    public function Select_Recent_User(){
        $query = "SELECT * FROM users ORDER BY Creation_Date DESC limit 3";
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
        $Share_Temp=100;
        $val = ["Admins" => $Admin, "Users" => $User,"Shared" =>$Share_Temp];
        return  $val ;
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
            if($row['Expiry']>$current_date){
               if ($Password === $stored_password) {
                  return "Success";
                } else {
                  return "Decline";
                }
            }
            else{
                return "Expired";
            }
        } else {
            return 'Decline';
        }
    }
  
     public function Admin_forgot_pass($Mail){
        $query = "SELECT * FROM admin WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
         if (mysqli_num_rows($result) == 1) {
            return "Success";
         }else{
            return "Decline";
         }
     }

      public function Admin_otp($otp){
        $Myotp = 123456;
        if($otp==$Myotp){   
            return "Success";
        }else{
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
    
    //////////////// user

    public function user_login($Mail,$Password){
        $query = "SELECT * FROM users WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['Password'];
            if ($Password === $stored_password) {
                return "Success";
            } else {
                return "Decline";
            }
        } 
        else {
            return 'Decline';
        }
    }

    public function user_forgot_pass($Mail){
        $query = "SELECT * FROM users WHERE Mail='$Mail'";
        $result = mysqli_query($this->conn, $query);
         if (mysqli_num_rows($result) == 1) {
            return "Success";
         }else{
            return "Decline";
         }
     }

      public function user_otp($otp){
        $Myotp = 123456;
        if($otp==$Myotp){   
            return "Success";
        }else{
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

    public function Select_videos(){
        $sql = "SELECT * FROM videos";
        $result = mysqli_query($this->conn, $sql);
        
        if ($result->num_rows > 0) {
          $videos = array();
          while($row = $result->fetch_assoc()) {
            $videos[] = $row;
          }
          return $videos; // Output JSON response
        } else {
          return "No videos found";
        }
    }


}
?>