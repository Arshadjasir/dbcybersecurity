<?php

include_once '../../../config/database.php';


class Delete
{
    public $conn;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function delete_Admin($id){
        try {
            $sql_select = "SELECT * FROM admin WHERE id = $id";
            $result = mysqli_query($this->conn, $sql_select);
            if ($result->num_rows > 0) {    
             $row = $result->fetch_assoc();
             $Name=$row['Name'];
             $Mail=$row['Mail'];
             $Password=$row['Password'];
             $createdate=$row['createdate'];
             $Companyname=$row['Companyname'];
             $sql_insert = "INSERT INTO removed_admin (	Name, Mail, Password, createdate,Companyname) VALUES ('$Name','$Mail','$Password','$createdate','$Companyname')";
              if (mysqli_query($this->conn, $sql_insert) === TRUE) {
                  $sql_delete =   "delete from admin where id ='$id' ";
                         if ($this->conn->query($sql_delete) === TRUE) {
                               return "Success";
                         } else {
                             return "Not Delete";
                         }
                  } else {
                     return "Not inserted";
                 }
            } else {
                return "wrong id";
            }
           
        } catch (\Throwable $th) {
           return $th;
        }
        return "success";
    }

    public function delete_User($id){
        try {
            //code...
            $query = "delete from users where id ='$id' ";
            $result = mysqli_query($this->conn, $query);
        } catch (\Throwable $th) {
           return $th;
        }
       
        return "success";
    }
}
?>