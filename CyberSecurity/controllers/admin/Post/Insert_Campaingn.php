<?php
// include_once '../../../config/header.php';
// include_once '../../../models/post.php';

// $data = json_decode(file_get_contents('php://input')); 
// $obj = new Post();
// $result = $obj->insert_Campaingn($data->Id,$data->Type,$data->Campaingn,$data->link);
// echo json_encode($result); 

include_once '../../../config/header.php';
include_once '../../../models/post.php';

$data = json_decode(file_get_contents('php://input'));
$Sendlink = $data->send;
$Campaingn = $data->popupval;
$Email = $data->Email;
$Filepath = $data->filepath;
$obj = new Post();
$result = $obj->insert_Campaingn($Sendlink,$Campaingn,$Email,$Filepath);

echo json_encode($result); 

?>