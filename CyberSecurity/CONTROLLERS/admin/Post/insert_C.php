<?php
include_once '../../../config/header.php';
include_once '../../../models/post.php';

$data = json_decode(file_get_contents('php://input'));

$obj = new Post();
$result = $obj->insert_C();

echo json_encode($result); 

?>