<?php
include_once '../../../config/header.php';
include_once '../../../models/get.php';


$data = json_decode(file_get_contents('php://input')); 
$obj = new Get();
$result = $obj->Admin_Select_Videos();
echo json_encode($result);
?>