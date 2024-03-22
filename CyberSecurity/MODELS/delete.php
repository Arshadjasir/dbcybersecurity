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
            //code...
            $query = "delete from notes where id ='$id' ";
            $result = mysqli_query($this->conn, $query);
        } catch (\Throwable $th) {
           return $th;
        }
       
        return "success";
    }
}
?>