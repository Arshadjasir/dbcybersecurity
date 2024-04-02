<?php
include_once '../../../config/header.php';
include_once '../../../models/post.php';

$data = json_decode(file_get_contents('php://input')); 
$obj = new Post();
$result = $obj->insert_User($data->Name,$data->User,$data->Mail,$data->Password,$data->Whatsapp,$data->Facebook,$data->Instagram,$data->isActive,$data->Adminid);
echo json_encode($result); 
?>