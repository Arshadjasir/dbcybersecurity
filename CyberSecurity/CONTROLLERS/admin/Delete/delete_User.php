<?php
include_once '../../../config/header.php';
include_once '../../../models/delete.php';


$data = json_decode(file_get_contents('php://input')); 
$obj = new Delete();
$result = $obj->delete_User($data->id);
echo json_encode($result);
?>