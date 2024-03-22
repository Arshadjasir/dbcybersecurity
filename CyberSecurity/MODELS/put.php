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


public function update_Admin($filename,$id){
  $query = "UPDATE notes set FileName ='$filename' where id ='$id'  ";
  mysqli_query($this->conn, $query);
  return "Success";
}

}
?>