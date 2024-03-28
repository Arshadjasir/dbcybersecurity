<?php
include_once '../../../config/header.php';
include_once '../../../models/put.php';

// Check if the request method is POST

  // Get POST data
  $data = json_decode(file_get_contents('php://input')); 

  $mail = isset($data->Mail) ? $data->Mail : '';
  $whatsapp = isset($data->Whatsapp) ? $data->Whatsapp : '';
  $facebook = isset($data->Facebook) ? $data->Facebook : '';
  $instagram = isset($data->Instagram) ? $data->Instagram : '';

  // Create an instance of the Put class
  $obj = new Put();

  // Call the update_User method
  $result = $obj->update_profile( $mail, $whatsapp, $facebook, $instagram);

  // Send JSON response
  echo json_encode($result);

?>