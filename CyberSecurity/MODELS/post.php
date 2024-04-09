<?php

include_once '../../../config/database.php';


class Post
{
    public $conn;

    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

public function insert_Admin($Name,$Mail,$Password,$Expiry,$active,$Companyname){
    try {
     $get = "Select * from admin where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    $current_date = date('Y-m-d');
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into admin (Name,Mail,Password,Expiry,active,Companyname,Expiry_video) values ('$Name','$Mail','$Password','$Expiry','$active','$Companyname','$current_date') ";
    $result = mysqli_query($this->conn, $query);
    return "success";
    }else{
    return "userexist";
    }
    } catch (\Throwable $th) {
        throw $th;
    }
}
public function insert_Campaingn($Sendlink,$Campaingn,$Email,$Filepath ){
        $query = "SELECT * FROM admin WHERE Mail='$Email'";
        $result = mysqli_query($this->conn, $query);
        $userlength = count($Sendlink);
        $Campaingn_id = "";
        $Campaingn_name = $Campaingn->{'Campaingn'};
        $Campaingn_Type = $Campaingn->{'Type'};
        $Campaingn_Mail = $Campaingn->{'link'};
        $Campaingn_File = $Campaingn->{'file'};
        // $current_date = date('Y-m-d');
         $que =  "SELECT * FROM campaingn ORDER BY createdate DESC limit 1";
         $res = mysqli_query($this->conn, $que);
         while ($row = $res->fetch_assoc()) {
            $Campaingn_id =  $row['id']+1;
         }
        if (mysqli_num_rows($result) == 1) {
            try {     
            $row = mysqli_fetch_assoc($result);
            $Admin_id = $row['id'];
            $insert = "insert into campaingn (id,No_of_Users,Campaingn_Name,Type,Admin_id) values ('$Campaingn_id','$userlength','$Campaingn_name','$Campaingn_Type ','$Admin_id') ";
            $final = mysqli_query($this->conn, $insert);
             $userid="";
             $usermail="";
             $linkid="?id=";
             $linkcam_id="&campaingn_id=";
             $Campaingn_link="";
            foreach ($Sendlink as $send ) {   
              $userid = $send->{'User'};
              $usermail = $send->{'Mail'};
              $Campaingn_link = $Campaingn_Mail.$linkid.$userid.$linkcam_id.$Campaingn_id;
              if($Filepath==""){
              $mailed = mail($usermail, "Your link from Vebbox Software Solution", $Campaingn_link);
              }elseif($Filepath!=""){
                 $email = $usermail;//Mail
                 $subject = "Your Link from vebbox software solution";
                 $content = $Campaingn_link;//link
                 $file_path = $Filepath;//file
                 $file_content = file_get_contents($file_path);
                //  $file_content = file_exists($file_path) ? file_get_contents($file_path) : false;
                 $attachment = chunk_split(base64_encode($file_content));
                 $boundary = md5(time());
                 $headers = "From: your_email@example.com\r\n";
                 $headers .= "MIME-Version: 1.0\r\n";
                 $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
                 $message = "--$boundary\r\n";
                 $message .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
                 $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                 $message .= $content."\r\n\r\n";
                 $message .= "--$boundary\r\n";
                 $message .= "Content-Type: application/pdf; name=\"attachment.pdf\"\r\n";
                 $message .= "Content-Disposition: attachment; filename=\"attachment.pdf\"\r\n";
                 $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
                 $message .= $attachment."\r\n\r\n";
                 $message .= "--$boundary--";
                 $mailed = mail($email, $subject, $message, $headers);
              }
              $ins = "insert into senddata (Campain_id,user_id) values ('$Campaingn_id','$userid') ";
              $fin = mysqli_query($this->conn, $ins);
              
            }
            } catch (\Throwable $th) {
                throw $th;
            }
             return "success";
            // return $file_content;
             } else{
                return "not";
             }  

}

// public function insert_Campaingn($Sendlink,$Campaingn,$Email,$File) {
// //  $_FILES['file']=$File;
//  $_FILES['file'] = array($File);
//  return $_FILES['file'];
//  if (is_array($File) && isset($File['name']) && isset($File['tmp_name'])) {
//     $file_name = $_FILES['file']['name'];
//     $file_tmp = $_FILES['file']['tmp_name'];
//     $file_destination = '../../../Uploads/' . $file_name;

//     if (move_uploaded_file($file_tmp, $file_destination)) {
//         // File uploaded successfully, now you can send an email with attachment
//         return $_FILES['file'];

//         $email = "arshadjasir007@gmail.com";
//         $subject = "File Upload";
//         $content = "File uploaded successfully.";

//         $file_content = file_get_contents($file_destination);
//         $attachment = chunk_split(base64_encode($file_content));

//         $boundary = md5(time());
//         $headers = "From: your_email@example.com\r\n";
//         $headers .= "MIME-Version: 1.0\r\n";
//         $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
//         $message = "--$boundary\r\n";
//         $message .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
//         $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
//         $message .= $content."\r\n\r\n";
//         $message .= "--$boundary\r\n";
//         $message .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";
//         $message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
//         $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
//         $message .= $attachment."\r\n\r\n";
//         $message .= "--$boundary--";

//         // $mail = mail($email, $subject, $message, $headers);
//         // if ($mail) {
//         //     return 
//         // } else {
//         //     echo "Failed to send email.";
//         // }
//     } else {
//         echo "Failed to upload file.";
//     }
// } else {
//     echo "Invalid request.";
// }
// }




public function insert_C(){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_destination = '../../../Uploads/' . $file_name;
    // return $file_destination;

    if (move_uploaded_file($file_tmp, $file_destination)) {
        // File uploaded successfully, now you can send an email with attachment
        $email = "arshadjasir007@gmail.com";
        $subject = "File Upload";
        $content = "File uploaded successfully.";

        $file_content = file_get_contents($file_destination);
        $attachment = chunk_split(base64_encode($file_content));

        $boundary = md5(time());
        $headers = "From: your_email@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $message = "--$boundary\r\n";
        $message .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= $content."\r\n\r\n";
        $message .= "--$boundary\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";
        $message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= $attachment."\r\n\r\n";
        $message .= "--$boundary--";

        return $file_destination;
        // $mail = mail($email, $subject, $message, $headers);
        // if ($mail) {
        //     return 
        // } else {
        //     echo "Failed to send email.";
        // }
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "Invalid request.";
}
}





public function insert_User($Name,$Mail,$Password,$Whatsapp,$Facebook,$Instagram,$isActive,$Adminid){
    try {
    $qu =  "SELECT * FROM users ORDER BY Creation_Date DESC limit 1";
    $res = mysqli_query($this->conn, $qu);
    $userid="";
    while ($row = $res->fetch_assoc()) {
        $userid = $row['id']+1;
    }
    $get = "Select * from users where Mail = '$Mail'";
    $getresult = mysqli_query($this->conn, $get);
    $current_date = date('Y-m-d');
    if(mysqli_num_rows($getresult)<=0){
    $query = "insert into users (id,Name,User,Mail,Password,Whatsapp,Facebook,Instagram,isActive,admin_id,Expiry_video) values ('$userid','$Name','$userid','$Mail','$Password','$Whatsapp','$Facebook','$Instagram','$isActive','$Adminid','$current_date') ";
    $result = mysqli_query($this->conn, $query);
    if($result){
        return "success";
    }else{
        return "not success";
    }   
    }else{
    return "userexist";
    }
    } catch (\Throwable $th) {
        throw $th;
    }
}
}
?>