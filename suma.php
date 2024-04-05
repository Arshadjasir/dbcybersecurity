<?php
public function insert_Campaingn($Sendlink,$Campaingn,$Email){
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
            //   $mailed = mail($usermail, "Your link from Vebbox Software Solution", $Campaingn_Mail);
              $ins = "insert into senddata (Campain_id,user_id) values ('$Campaingn_id','$userid') ";
              $fin = mysqli_query($this->conn, $ins);
            }
            } catch (\Throwable $th) {
                throw $th;
            }
            //  return "success";
             return $Campaingn_link;

             } else{
                return "not";
             }  

}
?>