<?php
    // header('Access-Control-Allow-Origin: *');
    
    // header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH,OPTIONS');
    // header('Access-Control-Allow-Headers: token, Content-Type');
    // header('Access-Control-Max-Age: 1728000');
    // header('Content-Length: 0');
    // header('Content-Type: text/plain');
?>

<?php
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//         header('Access-Control-Allow-Origin: *');
//         header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
//         header('Access-Control-Allow-Headers: token, Content-Type');
//         header('Access-Control-Max-Age: 1728000');
//         header('Content-Length: 0');
//         header('Content-Type: text/plain');
//         die();
//     }

//     header('Access-Control-Allow-Origin: *');
//     header('Content-Type: application/json');

//====================================================================
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
header('Access-Control-Allow-Headers: token, Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    // header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Include Authorization header
    header('Access-Control-Allow-Headers: token, Content-Type, Authorization');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Content-Type: application/json');

    ?>