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



   public function Superadmin_Mail_View(){
        $query = "SELECT * FROM superadmin WHERE Mail='superadmin@gmail.com'";
        $result = mysqli_query($this->conn, $query);
     if (mysqli_num_rows($result) == 1) {
             $row = mysqli_fetch_assoc($result);
             $mail=$row['Mail'];
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
   public function Campaign_id(){
     $query =  "SELECT * FROM campaingn ORDER BY createdate DESC limit 1";
      $result = mysqli_query($this->conn, $query);
        while ($row = $result->fetch_assoc()) {
            return $row['id']+1;
        }
    
   }
   public function Campaingn_Report(){
        $query = "SELECT * FROM campaingn ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()){
                  $temp[] = $row;
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
}

?>