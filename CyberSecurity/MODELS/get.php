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
<<<<<<< Updated upstream

=======
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
>>>>>>> Stashed changes
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
        $obj=[$Admin,$User,$Share_Temp];
        $fin = json_encode($obj);
        return  $fin ;
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
}
?>