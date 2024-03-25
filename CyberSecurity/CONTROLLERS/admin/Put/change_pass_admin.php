<?php
include_once '../../../config/header.php';
include_once '../../../models/put.php';

$data = json_decode(file_get_contents('php://input')); 
$obj = new Put();
$result = $obj->admin_Change_Pass($data->Name,$data->Mail,$data->Password,$data->oldPassword,$data->newPassword,$data->confirmPassword);
echo json_encode($result);
?>