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


    public function select_Admin($id){
        $query = "SELECT * FROM notes where id ='$id' ";
        $result = mysqli_query($this->conn, $query);
        $temp = array();
        while ($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
        return $temp;
    }

}
?>