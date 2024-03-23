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

public function update_User($Name,$User,$Mail,$Password,$Whatsapp,$Facebook,$Instagram,$id){
  try{
    $get = "Select * from users where Mail='$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    while($row=mysqli_fetch_assoc($getresult)){
     if($id==$row['id']){
      $query = "UPDATE users set Name='$Name', User='$User',Mail='$Mail',Password='$Password',Whatsapp='$Whatsapp',   Facebook='$Facebook',Instagram='$Instagram' where id ='$id'  ";
      if(mysqli_query($this->conn, $query);){
        return "Success";
      }
      else{
        return "userExist";
      }
     }
    }
  }
}
}
?>
